<?php

declare(strict_types=1);

$eventsPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'api-101-realtime-events.jsonl';
$action = $_GET['action'] ?? '';

function sendJson(array $payload, int $statusCode = 200): never
{
	http_response_code($statusCode);
	header('Content-Type: application/json; charset=utf-8');
	header('Cache-Control: no-store');
	echo json_encode($payload, JSON_INVALID_UTF8_SUBSTITUTE);
	exit;
}

if ($action === 'publish') {
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		header('Allow: POST');
		sendJson(['error' => 'Use POST to publish a message.'], 405);
	}

	$payload = json_decode(file_get_contents('php://input'), true);
	$message = is_array($payload) && is_string($payload['message'] ?? null)
		? trim($payload['message'])
		: '';

	if ($message === '' || strlen($message) > 500) {
		sendJson(['error' => 'Message must contain 1 to 500 characters.'], 422);
	}

	$file = fopen($eventsPath, 'c+');

	if ($file === false || !flock($file, LOCK_EX)) {
		if ($file !== false) {
			fclose($file);
		}

		sendJson(['error' => 'The event store is unavailable.'], 500);
	}

	rewind($file);
	$lines = array_values(array_filter(explode("\n", trim(stream_get_contents($file)))));
	$lastEvent = $lines === [] ? null : json_decode($lines[array_key_last($lines)], true);
	$event = [
		'id' => max((int) floor(microtime(true) * 1_000_000), (int) ($lastEvent['id'] ?? 0) + 1),
		'message' => $message,
		'sentAt' => date(DATE_ATOM),
	];

	$lines[] = json_encode($event, JSON_INVALID_UTF8_SUBSTITUTE);
	$lines = array_slice($lines, -100);
	rewind($file);
	ftruncate($file, 0);
	$written = fwrite($file, implode("\n", $lines) . "\n");
	fflush($file);
	flock($file, LOCK_UN);
	fclose($file);

	if ($written === false) {
		sendJson(['error' => 'The message could not be stored.'], 500);
	}

	sendJson(['data' => $event], 201);
}

if ($action === 'stream') {
	set_time_limit(0);
	ignore_user_abort(true);
	header('Content-Type: text/event-stream; charset=utf-8');
	header('Cache-Control: no-cache, no-transform');
	header('X-Accel-Buffering: no');

	while (ob_get_level() > 0) {
		ob_end_flush();
	}

	$lastEventId = (int) ($_SERVER['HTTP_LAST_EVENT_ID'] ?? 0);
	$lastHeartbeat = time();
	echo "retry: 2000\n\n";
	flush();

	while (!connection_aborted()) {
		$lines = is_file($eventsPath) ? file($eventsPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

		foreach ($lines ?: [] as $line) {
			$event = json_decode($line, true);

			if (!is_array($event) || (int) ($event['id'] ?? 0) <= $lastEventId) {
				continue;
			}

			$lastEventId = (int) $event['id'];
			echo 'id: ' . $lastEventId . "\n";
			echo "event: message\n";
			echo 'data: ' . json_encode($event, JSON_INVALID_UTF8_SUBSTITUTE) . "\n\n";
			flush();
		}

		if (time() - $lastHeartbeat >= 15) {
			echo ": keep-alive\n\n";
			flush();
			$lastHeartbeat = time();
		}

		usleep(500_000);
	}

	exit;
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Realtime Relay | API 101</title>
	<style>
		:root {
			color-scheme: light;
			font-family: "Segoe UI Variable", "Segoe UI", sans-serif;
			color: #172322;
			background: #f5f7f2;
			font-synthesis: none;
		}

		* { box-sizing: border-box; }

		body {
			min-width: 320px;
			min-height: 100vh;
			margin: 0;
			background-image: linear-gradient(#dce4dc 1px, transparent 1px), linear-gradient(90deg, #dce4dc 1px, transparent 1px);
			background-size: 32px 32px;
		}

		button, input { font: inherit; }

		.shell {
			width: min(100% - 40px, 760px);
			margin: 0 auto;
			padding: 38px 0 56px;
		}

		.topline, .status, .message-meta, .form-footer {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 12px;
		}

		.topline { color: #52635d; font: 600 12px/1.2 ui-monospace, Consolas, monospace; }
		.brand { display: flex; align-items: center; gap: 9px; }
		.brand-mark { width: 11px; height: 11px; background: #b3e64b; border: 2px solid #172322; border-radius: 50%; }

		main {
			margin-top: 52px;
			padding: clamp(24px, 6vw, 48px);
			border: 1px solid #cbd4ca;
			background: #fff;
			box-shadow: 8px 8px 0 #dce4dc;
		}

		.eyebrow { margin: 0 0 12px; color: #537765; font: 700 11px/1.3 ui-monospace, Consolas, monospace; letter-spacing: .08em; text-transform: uppercase; }
		h1 { margin: 0; font: 600 clamp(32px, 7vw, 52px)/1.02 Georgia, serif; letter-spacing: 0; }
		.intro { max-width: 490px; margin: 16px 0 28px; color: #52635d; line-height: 1.6; }

		.status { justify-content: flex-start; padding: 12px 0; border-top: 1px solid #e1e7df; border-bottom: 1px solid #e1e7df; color: #52635d; font: 600 12px ui-monospace, Consolas, monospace; }
		.status-dot { width: 9px; height: 9px; border-radius: 50%; background: #d88560; }
		.status[data-state="connected"] .status-dot { background: #55a65b; box-shadow: 0 0 0 3px #e5f3e3; }

		.composer { display: flex; gap: 10px; margin: 22px 0 30px; }
		.composer input { min-width: 0; flex: 1; padding: 13px 14px; border: 1px solid #bdc9be; border-radius: 2px; outline: none; }
		.composer input:focus { border-color: #38735a; box-shadow: 0 0 0 3px #e2f0e6; }
		.composer button { padding: 0 18px; border: 1px solid #172322; border-radius: 2px; background: #b3e64b; color: #172322; font-weight: 700; cursor: pointer; }
		.composer button:hover { background: #c3f467; }
		.composer button:disabled { cursor: wait; opacity: .6; }

		.feed-heading { display: flex; align-items: baseline; justify-content: space-between; padding-bottom: 10px; border-bottom: 1px solid #172322; }
		h2 { margin: 0; font: 600 19px Georgia, serif; }
		.feed-count { color: #718078; font: 11px ui-monospace, Consolas, monospace; }
		.feed { max-height: 340px; overflow-y: auto; }
		.empty { margin: 0; padding: 24px 0; color: #78847c; font-size: 14px; }
		.message { padding: 15px 0; border-bottom: 1px solid #e5e9e3; animation: arrive .24s ease-out both; }
		.message p { margin: 0 0 8px; overflow-wrap: anywhere; line-height: 1.45; }
		.message-meta { justify-content: flex-start; color: #718078; font: 10px ui-monospace, Consolas, monospace; }
		.message-id { color: #63806d; }
		.notice { min-height: 18px; margin: -20px 0 20px; color: #a34535; font-size: 12px; }
		.footnote { margin: 22px 0 0; color: #728078; font: 11px ui-monospace, Consolas, monospace; }

		@keyframes arrive { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
		@media (max-width: 520px) {
			.shell { width: min(100% - 24px, 760px); padding-top: 22px; }
			main { margin-top: 30px; box-shadow: 4px 4px 0 #dce4dc; }
			.composer { flex-direction: column; }
			.composer button { min-height: 46px; }
		}
		@media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; } }
	</style>
</head>
<body>
	<div class="shell">
		<div class="topline">
			<div class="brand"><span class="brand-mark" aria-hidden="true"></span><span>API 101 / REALTIME</span></div>
			<span>SERVER-SENT EVENTS</span>
		</div>

		<main>
			<p class="eyebrow">A tiny live message relay</p>
			<h1>Messages, as they happen.</h1>
			<p class="intro">Send an update from this tab and watch it arrive instantly in every other tab connected to this page.</p>

			<div class="status" id="connection-status" data-state="connecting" role="status" aria-live="polite">
				<span class="status-dot" aria-hidden="true"></span>
				<span id="connection-label">Connecting to event stream...</span>
			</div>

			<form class="composer" id="message-form">
				<input id="message-input" name="message" maxlength="500" placeholder="Write a short update..." autocomplete="off" required>
				<button id="send-button" type="submit">Send update</button>
			</form>
			<p class="notice" id="notice" role="alert"></p>

			<section aria-labelledby="feed-title">
				<div class="feed-heading">
					<h2 id="feed-title">Live feed</h2>
					<span class="feed-count" id="feed-count">0 EVENTS</span>
				</div>
				<div class="feed" id="feed" aria-live="polite" aria-relevant="additions">
					<p class="empty" id="empty-state">Waiting for the first update.</p>
				</div>
			</section>

			<p class="footnote">GET ?action=stream &nbsp;·&nbsp; POST ?action=publish</p>
		</main>
	</div>

	<script>
		const statusBar = document.querySelector('#connection-status');
		const connectionLabel = document.querySelector('#connection-label');
		const feed = document.querySelector('#feed');
		const feedCount = document.querySelector('#feed-count');
		const emptyState = document.querySelector('#empty-state');
		const form = document.querySelector('#message-form');
		const input = document.querySelector('#message-input');
		const sendButton = document.querySelector('#send-button');
		const notice = document.querySelector('#notice');
		let eventCount = 0;

		const stream = new EventSource(`${location.pathname}?action=stream`);

		stream.onopen = () => {
			statusBar.dataset.state = 'connected';
			connectionLabel.textContent = 'Connected · updates are live';
		};

		stream.onerror = () => {
			statusBar.dataset.state = 'connecting';
			connectionLabel.textContent = 'Reconnecting to event stream...';
		};

		stream.addEventListener('message', (event) => {
			const update = JSON.parse(event.data);
			emptyState?.remove();

			const item = document.createElement('article');
			item.className = 'message';
			const text = document.createElement('p');
			text.textContent = update.message;
			const meta = document.createElement('div');
			meta.className = 'message-meta';
			const id = document.createElement('span');
			id.className = 'message-id';
			id.textContent = `#${update.id}`;
			const time = document.createElement('time');
			time.dateTime = update.sentAt;
			time.textContent = new Date(update.sentAt).toLocaleTimeString();
			meta.append(id, time);
			item.append(text, meta);
			feed.prepend(item);

			eventCount += 1;
			feedCount.textContent = `${eventCount} EVENT${eventCount === 1 ? '' : 'S'}`;
		});

		form.addEventListener('submit', async (event) => {
			event.preventDefault();
			notice.textContent = '';
			sendButton.disabled = true;

			try {
				const response = await fetch(`${location.pathname}?action=publish`, {
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify({ message: input.value }),
				});
				const result = await response.json();

				if (!response.ok) {
					throw new Error(result.error || 'Could not send update.');
				}

				input.value = '';
				input.focus();
			} catch (error) {
				notice.textContent = error.message;
			} finally {
				sendButton.disabled = false;
			}
		});
	</script>
</body>
</html>
