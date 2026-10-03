<?php

// Tell the browser to keep this response open as an SSE stream.
header('Content-Type: text/event-stream; charset=utf-8');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

// Send five events by default. The count can be changed with ?count=10.
$eventCount = isset($_GET['count']) ? (int) $_GET['count'] : 5;
$eventCount = max(1, min($eventCount, 20));

set_time_limit(0);


for ($eventNumber = 1; $eventNumber <= $eventCount; $eventNumber++) {
	// Stop sending events after the browser closes the connection.
	if (connection_aborted()) {
		break;
	}

	// Each SSE event needs a data line and a blank line at the end.
	echo 'id: ' . $eventNumber . "\n";
	echo 'data: Event ' . $eventNumber . ' at ' . date('H:i:s') . "\n\n";

	// Send the event immediately instead of waiting for the buffer to fill.
	if (ob_get_level() > 0) {
		ob_flush();
	}
	flush();

	// Wait between events, but don't delay the final response.
	if ($eventNumber < $eventCount) {
		sleep(1);
	}
}


