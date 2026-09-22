<?php
$data = require __DIR__ . '/../config/data.php';
$pageMetadata = $data['pageMetadata'];
$siteLinks = $data['siteLinks'];
$indexLinks = $data['indexLinks'];
$indexApi = $data['indexApi'];
$pageTitle = $pageMetadata['home']['title'];
$pageDescription = $pageMetadata['home']['description'];

include_once __DIR__ . '/../components/icon.php';
ob_start();


?>

<div class="weather-widget" id="weather-widget">
    <div class="weather-loading" id="weather-loading">Loading weather...</div>
    <div class="weather-content" id="weather-content" hidden>
        <div class="weather-header">
            <div class="weather-icon" id="weather-icon" aria-hidden="true"><i class="fa-solid fa-cloud-bolt"></i></div>
            <div class="weather-temp-block">
                <div class="temperature" id="weather-temperature"></div>
                <div class="unit">°C</div>
            </div>
        </div>
        <div class="weather-location-block">
            <div class="location-main" id="weather-city"></div>
            <div class="location-sub" id="weather-country"></div>
            <div class="time-sub" id="weather-date"></div>
        </div>
        <div class="weather-details">
            <span id="weather-precipitation"></span>
            <span id="weather-humidity"></span>
            <span id="weather-wind"></span>
        </div>
    </div>
</div>

<section class="portfolio-hero">
    <div class="portfolio-hero__content">
        <p class="portfolio-hero__eyebrow"><span>•</span> Available for consulting &amp; projects</p>
        <h1>Ronnie Legaspi</h1>
        <p class="portfolio-hero__role">Backend Developer · API Integrations, Security &amp; Systems</p>
        <p class="portfolio-hero__text">
            I build secure APIs and reliable backend systems that turn complex requirements into practical products.
        </p>

        <div class="portfolio-hero__actions">
            <a href="projects.php" class="portfolio-hero__button portfolio-hero__button--primary">View My Work</a>
            <a href="book-schedule.php" class="portfolio-hero__button portfolio-hero__button--secondary">Get in Touch</a>
        </div>
    </div>

    <div class="portfolio-hero__visual">
        <div class="portfolio-hero__image-wrap">
            <img src="../../assets/images/profile.jpg" alt="Portrait of Ronnie Legaspi, backend developer" class="portfolio-hero__image" width="330" height="330" fetchpriority="high">
        </div>

        <div class="portfolio-hero__contrib-card">
            <div class="portfolio-hero__contrib-header">
                <span>GitHub contributions</span>
                <a href="<?php echo htmlspecialchars($siteLinks['github_profile'], ENT_QUOTES, 'UTF-8'); ?>" class="portfolio-hero__profile-link">View profile</a>
            </div>
            <div class="portfolio-hero__contrib-placeholder">
                <div class="contrib-loader" id="contrib-loader">
                    <?php include __DIR__ . '/../components/loader.php'; ?>
                </div>
                <img
                    src="<?php echo htmlspecialchars($indexLinks['github_contributions'], ENT_QUOTES, 'UTF-8'); ?>"
                    alt="GitHub contribution activity for Ronnie Legaspi"
                    loading="lazy"
                    class="portfolio-hero__contrib-image">
            </div>
        </div>
    </div>
</section>

<section class="portfolio-section">
    <div class="portfolio-section__heading">
        <p class="portfolio-section__eyebrow">What I do</p>
        <h2>Backend-first development with a full-stack perspective.</h2>
    </div>

    <div class="portfolio-grid">
        <article class="portfolio-card">
            <span class="portfolio-card__tag">APIs</span>
            <h3><?php echo portfolioIcon('api', 'API integrations'); ?>Reliable Integrations</h3>
            <p>REST APIs and third-party integrations that connect products, services, and useful data.</p>
        </article>

        <article class="portfolio-card">
            <span class="portfolio-card__tag">Backend</span>
            <h3><?php echo portfolioIcon('shield', 'Secure backend systems'); ?>Secure Systems</h3>
            <p>Laravel, Node.js, authentication, authorization, and maintainable logic for real workflows.</p>
        </article>

        <article class="portfolio-card">
            <span class="portfolio-card__tag">Data</span>
            <h3><?php echo portfolioIcon('database', 'Database foundations'); ?>Strong Foundations</h3>
            <p>MySQL, PostgreSQL, schema design, and query optimization that keep applications dependable.</p>
        </article>
    </div>
</section>
<section class="portfolio-section portfolio-video-section">
    <div class="portfolio-video" data-video-autoplay>
        <div class="video-loader" id="video-loader">
            <?php include __DIR__ . '/../components/loader.php'; ?>
        </div>
        <iframe
            src="<?php echo htmlspecialchars($indexLinks['jobdocs_video_embed'], ENT_QUOTES, 'UTF-8'); ?>"
            title="JobDocs Roadmap video"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen>
        </iframe>
    </div>
</section>

<section class="portfolio-section portfolio-section--jobdocs">
    <div class="portfolio-section__heading">
        <p class="portfolio-section__eyebrow">Featured project</p>
        <h2>JobDocs Roadmap makes employment preparation easier to follow.</h2>
    </div>

    <div class="jobdocs-intro">
        <p>
            JobDocs Roadmap is a lightweight guide for first-time job seekers, recent graduates, and students in the
            Philippines. It explains which documents to prepare, where to get them, and how to work through the process
            without the usual uncertainty.
        </p>
        <p>
            Built with HTML, Tailwind CSS, and React.js via CDN, the app turns a confusing checklist into a practical,
            step-by-step path toward becoming employment ready.
        </p>
    </div>
    <div class="jobdocs-links">
        <a class="jobdocs-link jobdocs-link--primary" href="<?php echo htmlspecialchars($indexLinks['jobdocs_roadmap'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
            <?php echo portfolioIcon('briefcase', 'Open the JobDocs Roadmap project'); ?>View the project
        </a>
        <a class="jobdocs-link jobdocs-link--secondary" href="<?php echo htmlspecialchars($indexLinks['jobdocs_roadmap_video'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
            <?php echo portfolioIcon('play', 'Watch the JobDocs Roadmap video'); ?>Watch on YouTube
        </a>
    </div>

    <div class="jobdocs-documents">
        <article class="jobdocs-document">
            <strong>NBI Clearance</strong>
            <span>Verifies an applicant's national criminal record</span>
            <small>National Bureau of Investigation</small>
        </article>
        <article class="jobdocs-document">
            <strong>Police Clearance</strong>
            <span>Confirms there are no local police records or cases</span>
            <small>Local police departments</small>
        </article>
        <article class="jobdocs-document">
            <strong>PSA Birth Certificate</strong>
            <span>Provides proof of identity and citizenship</span>
            <small>Philippine Statistics Authority</small>
        </article>
        <article class="jobdocs-document">
            <strong>SSS, PhilHealth &amp; Pag-IBIG</strong>
            <span>Organizes essential government benefit registrations</span>
            <small>Government service agencies</small>
        </article>
    </div>
</section>

<section class="portfolio-section portfolio-section--split">
    <div class="portfolio-copy">
        <p class="portfolio-section__eyebrow">About Me</p>
        <h2>Practical technology, built with care.</h2>
        <p>
            I enjoy solving difficult problems through clean code, thoughtful interfaces, and systems that are
            secure, testable, and easy for teams to maintain.
        </p>
    </div>

    <div class="portfolio-focus">
        <div class="portfolio-focus__item">
            <strong>Problem solving</strong>
            <span>Debugging, testing, and clear technical decisions</span>
        </div>
        <div class="portfolio-focus__item">
            <strong>API focused</strong>
            <span>Integrations that connect products and services</span>
        </div>
        <div class="portfolio-focus__item">
            <strong>Team ready</strong>
            <span>Readable systems built for collaboration</span>
        </div>
    </div>
</section>

<style>
    .portfolio-hero {
        width: min(1180px, calc(100% - 2rem));
        margin: 0 auto;
        min-height: calc(100vh - 76px);
        display: grid;
        grid-template-columns: 1fr 1.15fr;
        gap: 2.2rem;
        align-items: center;
        padding: 0.5rem 0 3rem;
    }

    .portfolio-hero__content {
        min-height: 580px;
        padding: 1rem 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .weather-widget[hidden],
    .weather-content[hidden] {
        display: none;
    }

    .weather-widget {
        width: min(1180px, calc(100% - 2rem));
        min-height: 0;
        margin: 0 auto;
        padding: 0.35rem 0;
        color: #64748b;
        display: flex;
        justify-content: flex-start;
    }

    .weather-loading {
        display: flex;
        align-items: center;
        color: #64748b;
        font-size: 0.78rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .weather-content {
        display: grid;
        grid-template-columns: minmax(100px, 0.8fr) minmax(130px, 1fr) minmax(180px, 1.4fr);
        grid-template-rows: repeat(2, minmax(1.5rem, auto));
        align-items: center;
        column-gap: 1.5rem;
        row-gap: 0.15rem;
        width: 100%;
    }

    .weather-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        grid-column: 1;
        grid-row: 1 / span 2;
    }

    .weather-icon {
        color: #f59e0b;
        font-size: 2rem;
        line-height: 1;
    }

    .weather-temp-block {
        display: flex;
        align-items: flex-start;
        color: #111827;
    }

    .temperature {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
    }

    .unit {
        margin-left: 0.2rem;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .weather-location-block {
        min-width: 130px;
        grid-column: 2;
        grid-row: 1 / span 2;
    }

    .location-main {
        color: #111827;
        font-weight: 700;
    }

    .location-sub,
    .time-sub,
    .weather-summary,
    .weather-details {
        color: #64748b;
        font-size: 0.78rem;
    }

    .weather-details {
        margin-top: 5px;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, max-content));
        gap: 0.2rem 0.8rem;
        /* margin-top: 0; */
        margin-left: 0;
        color: #64748b;
        font-size: 0.7rem;
        line-height: 1.35;
        grid-column: 3;
        grid-row: 1;
    }

    .portfolio-hero__eyebrow,
    .portfolio-section__eyebrow {
        margin: 0 0 0.9rem;
        font-size: 0.75rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #2563eb;
        font-weight: 700;
    }

    .portfolio-hero h1 {
        margin: 0;
        font-size: clamp(2.5rem, 5vw, 5rem);
        line-height: 0.98;
        letter-spacing: -0.06em;
        color: #111827;
    }

    .portfolio-hero__text {
        max-width: 660px;
        margin-top: 1.15rem;
        font-size: 1rem;
        line-height: 1.7;
        color: #5b6472;
    }

    .portfolio-hero__role {
        margin: 1rem 0 0;
        font-size: 1.12rem;
        line-height: 1.5;
        color: #64748b;
    }

    .portfolio-hero__actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .portfolio-hero__button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        padding: 0.95rem 1.5rem;
        font-weight: 700;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        text-decoration: none;
    }

    .portfolio-hero__button:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.12);
    }

    .portfolio-hero__button--primary {
        background: #2563eb;
        color: #fff;
    }

    .portfolio-hero__button--secondary {
        background: #eef4ff;
        color: #1d4ed8;
    }

    .portfolio-hero__visual {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.2rem;
    }

    .portfolio-hero__image-wrap {
        width: min(330px, 80vw);
        height: min(330px, 80vw);
        aspect-ratio: 1 / 1;
        border-radius: 50%;
        overflow: hidden;
        box-sizing: border-box;
        padding: 0.6rem;
        background: linear-gradient(135deg, #2563eb, #dbeafe);
        box-shadow: 0 18px 40px rgba(37, 99, 235, 0.14);
    }

    .portfolio-hero__image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
        border-radius: 50%;
        background: #f3f4f6;
    }

    .portfolio-hero__contrib-card {
        width: 100%;
        max-width: 620px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 22px;
        box-shadow: 0 18px 36px rgba(15, 23, 42, 0.06);
        padding: 1rem 1rem 0.85rem;
    }

    .portfolio-hero__contrib-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        margin-bottom: 0.8rem;
        font-weight: 700;
        color: #111827;
    }

    .portfolio-hero__contrib-header span {
        font-size: 0.96rem;
    }

    .portfolio-hero__profile-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.45rem 0.8rem;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        text-decoration: none;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 700;
    }

    .portfolio-hero__contrib-placeholder {
        width: 100%;
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        overflow: hidden;
        padding: 1rem;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
    }

    .contrib-loader {
        position: absolute;
        inset: 0;
        z-index: 1;
        opacity: 1;
        visibility: visible;
        transition: opacity 0.2s ease, visibility 0.2s ease;
    }

    .contrib-loader.is-hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .contrib-loader .loader {
        height: 100%;
        min-height: 0;
        box-sizing: border-box;
        border-radius: 0;
        background: #f8fafc;
    }

    .portfolio-hero__contrib-image {
        display: block;
        width: 100%;
        max-width: 560px;
        height: auto;
        object-fit: contain;
    }

    .portfolio-section {
        width: min(1180px, calc(100% - 2rem));
        margin: 0 auto;
        padding: 2rem 0 4rem;
    }

    .portfolio-video-section {
        padding-top: 0;
    }

    .portfolio-video {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        border-radius: 20px;
        background: #0f172a;
        box-shadow: 0 18px 36px rgba(15, 23, 42, 0.12);
    }

    .video-loader {
        position: absolute;
        inset: 0;
        z-index: 1;
        opacity: 1;
        visibility: visible;
        transition: opacity 0.2s ease, visibility 0.2s ease;
    }

    .video-loader.is-hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .video-loader .loader {
        height: 100%;
        min-height: 0;
        box-sizing: border-box;
        border-radius: 0;
    }

    .portfolio-video iframe {
        display: block;
        width: 100%;
        height: 100%;
        border: 0;
    }

    .portfolio-section__heading {
        margin-bottom: 1.5rem;
    }

    .portfolio-section__heading h2,
    .portfolio-copy h2 {
        margin: 0;
        color: #111827;
        font-size: clamp(1.9rem, 3vw, 2.7rem);
        line-height: 1.15;
        letter-spacing: -0.04em;
    }

    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1.25rem;
    }

    .portfolio-section--jobdocs {
        padding-top: 0;
    }

    .jobdocs-intro {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 2rem;
        max-width: 980px;
        margin-bottom: 1.5rem;
    }

    .jobdocs-intro p {
        margin: 0;
        color: #5b6472;
        line-height: 1.75;
    }

    .jobdocs-links {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .jobdocs-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1rem;
        border-radius: 999px;
        font-size: 0.86rem;
        font-weight: 700;
        text-decoration: none;
    }

    .jobdocs-link--primary {
        background: #2563eb;
        color: #ffffff;
    }

    .jobdocs-link--secondary {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .jobdocs-documents {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
    }

    .jobdocs-document {
        display: flex;
        flex-direction: column;
        gap: 0.55rem;
        min-height: 170px;
        padding: 1.2rem;
        border-top: 3px solid #2563eb;
        background: #f8fafc;
    }

    .jobdocs-document strong {
        color: #111827;
        font-size: 1.05rem;
    }

    .jobdocs-document span,
    .jobdocs-document small {
        color: #5b6472;
        line-height: 1.55;
    }

    .jobdocs-document small {
        margin-top: auto;
        color: #2563eb;
        font-size: 0.76rem;
        font-weight: 700;
    }

    .portfolio-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 1.4rem;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
    }

    .portfolio-card__tag {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 0.68rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        font-weight: 700;
        padding: 0.4rem 0.7rem;
        border-radius: 999px;
    }

    .portfolio-card h3 {
        margin: 1rem 0 0.7rem;
        color: #111827;
        font-size: 1.4rem;
    }

    .portfolio-card p,
    .portfolio-copy p,
    .portfolio-focus__item span {
        margin: 0;
        color: #5b6472;
        line-height: 1.75;
    }

    .portfolio-section--split {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 1.5rem;
        align-items: center;
    }

    .portfolio-copy {
        padding-right: 1rem;
    }

    .portfolio-focus {
        display: grid;
        gap: 1rem;
    }

    .portfolio-focus__item {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 1.1rem 1.2rem;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
    }

    .portfolio-focus__item strong {
        display: block;
        color: #111827;
        font-size: 1.05rem;
        margin-bottom: 0.25rem;
    }

    @media (max-width: 860px) {
        .weather-content {
            grid-template-columns: minmax(90px, 0.8fr) minmax(120px, 1fr);
            grid-template-rows: auto auto auto;
            gap: 0.65rem 1rem;
        }

        .weather-location-block {
            min-width: 0;
        }

        .weather-header {
            grid-column: 1;
            grid-row: 1 / span 2;
        }

        .weather-location-block {
            grid-column: 2;
            grid-row: 1 / span 2;
        }

        .weather-details {
            grid-column: 1 / -1;
            grid-row: 3;
        }

        .portfolio-hero,
        .portfolio-section--split,
        .portfolio-grid,
        .jobdocs-intro,
        .jobdocs-documents {
            grid-template-columns: 1fr;
        }

        .portfolio-hero {
            min-height: auto;
            padding-top: 1.5rem;
        }

        .portfolio-hero__content {
            min-height: auto;
        }

        .portfolio-hero__panel {
            grid-template-columns: 1fr;
        }

        .jobdocs-document {
            min-height: auto;
        }
    }
</style>

<script>
    (function () {
        const weatherWidget = document.getElementById('weather-widget');
        const weatherLoading = document.getElementById('weather-loading');
        const weatherContent = document.getElementById('weather-content');

        const loadWeather = async () => {
            if (!weatherWidget) return;

            try {
                const response = await fetch(<?php echo json_encode($indexApi['weather']['url'] . '?city=' . rawurlencode($indexApi['weather']['city']), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>, {
                    headers: { Accept: 'application/json' },
                });
                const payload = await response.json();

                if (!response.ok || payload.success !== true || !payload.data || !payload.weather) {
                    weatherWidget.hidden = true;
                    return;
                }

                const weather = payload.weather;
                document.getElementById('weather-temperature').textContent = Math.round(Number(weather.temperature));
                document.getElementById('weather-city').textContent = payload.data.city || 'Manila';
                document.getElementById('weather-country').textContent = payload.data.country || 'Philippines';
                document.getElementById('weather-date').textContent = new Intl.DateTimeFormat('en-US', {
                    month: 'short',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true,
                    timeZone: 'Asia/Manila',
                }).format(new Date());
                document.getElementById('weather-icon').innerHTML = '<i class="fa-solid fa-cloud-bolt"></i>';
                document.getElementById('weather-humidity').textContent = `Humidity: ${weather.humidity}%`;
                document.getElementById('weather-precipitation').textContent = `Precipitation: ${Math.max(0, Math.min(100, Number(weather.humidity)))}%`;
                document.getElementById('weather-wind').textContent = `Wind ${weather.wind_speed} km/h`;
                weatherLoading.hidden = true;
                weatherLoading.style.display = 'none';
                weatherContent.hidden = false;
                weatherContent.style.display = 'flex';
            } catch (error) {
                weatherWidget.hidden = true;
            }
        };

        loadWeather();

        const contributionImage = document.querySelector('.portfolio-hero__contrib-image');
        const contributionLoader = document.getElementById('contrib-loader');

        const hideContributionLoader = () => {
            if (contributionLoader) contributionLoader.classList.add('is-hidden');
        };

        if (contributionImage) {
            contributionImage.addEventListener('load', hideContributionLoader, { once: true });
            contributionImage.addEventListener('error', hideContributionLoader, { once: true });

            if (contributionImage.complete) hideContributionLoader();
        }

        const video = document.querySelector('[data-video-autoplay]');

        if (!video) return;

        const iframe = video.querySelector('iframe');
        const loader = document.getElementById('video-loader');
        let playerReady = false;

        const hideLoader = () => {
            if (loader) loader.classList.add('is-hidden');
        };

        const sendCommand = (command) => {
            if (!playerReady || !iframe.contentWindow) return;

            iframe.contentWindow.postMessage(JSON.stringify({
                event: 'command',
                func: command,
                args: [],
            }), <?php echo json_encode($indexApi['youtube_origin'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>);
        };

        iframe.addEventListener('load', () => {
            playerReady = true;
            hideLoader();
        });

        const observer = new IntersectionObserver(([entry]) => {
            sendCommand(entry.isIntersecting ? 'playVideo' : 'pauseVideo');
        }, { threshold: 0.45 });

        observer.observe(video);
    }());
</script>

<?php
$content = ob_get_clean();
include '../layout/layout.php';
?>
