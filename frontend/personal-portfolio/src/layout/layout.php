<?php
$data = require __DIR__ . '/../config/data.php';
$siteMetadata = $data['siteMetadata'];
$siteAssets = $data['siteAssets'];
$siteContact = $data['siteContact'];
$siteLinks = $data['siteLinks'];

$pageTitle = $pageTitle ?? 'Ronnie Legaspi | Backend Developer';
$pageDescription = $pageDescription ?? 'Ronnie Legaspi is a backend-focused full-stack web developer specializing in Laravel, PHP, REST APIs, React, security, and reliable digital systems.';
$siteUrl = rtrim($_ENV['APP_URL'] ?? $siteMetadata['site_url'], '/');
$currentScript = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
$canonicalPath = $currentScript === 'index.php' ? '/' : '/' . $currentScript;
$canonicalUrl = $siteUrl . $canonicalPath;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    // Load the frontend environment so the application title can come from frontend/.env.
    require_once dirname(__DIR__, 3) . '/vendor/autoload.php';
Dotenv\Dotenv::createImmutable(dirname(__DIR__, 3))->safeLoad();
?>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="author" content="<?php echo htmlspecialchars($siteMetadata['author'], ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#ffffff">
    <meta name="format-detection" content="telephone=no">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="preconnect" href="<?php echo htmlspecialchars($siteAssets['unpkg_preconnect'], ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="preconnect" href="<?php echo htmlspecialchars($siteAssets['tile_preconnect'], ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="stylesheet" href="<?php echo htmlspecialchars($siteAssets['font_awesome_css'], ENT_QUOTES, 'UTF-8'); ?>" crossorigin="anonymous" referrerpolicy="no-referrer">

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($siteUrl . '/assets/images/profile.jpg', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:site_name" content="<?php echo htmlspecialchars($siteMetadata['site_name'], ENT_QUOTES, 'UTF-8'); ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($siteUrl . '/assets/images/profile.jpg', ENT_QUOTES, 'UTF-8'); ?>">

    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>

    <script type="application/ld+json">
        <?php echo json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => 'Ronnie Hortizuela Legaspi',
            'jobTitle' => 'Backend Developer',
            'description' => $pageDescription,
            'url' => $siteUrl,
            'email' => $siteContact['email'],
            'telephone' => $siteContact['phone'],
            'sameAs' => [$siteLinks['github_profile'], $siteLinks['linkedin_profile']],
            'knowsAbout' => ['PHP', 'Laravel', 'REST APIs', 'React', 'Node.js', 'MySQL', 'PostgreSQL'],
        ], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>
    </script>

    <link 
        rel="stylesheet" 
        href="<?php echo htmlspecialchars($siteAssets['leaflet_css'], ENT_QUOTES, 'UTF-8'); ?>"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
            <style>
                .portfolio-icon {
                    display: inline-flex;
                    width: 1.15rem;
                    height: 1.15rem;
                    margin-right: 0.45rem;
                    vertical-align: -0.2rem;
                    color: #2563eb;
                }

                .portfolio-icon svg {
                    width: 100%;
                    height: 100%;
                    fill: none;
                    stroke: currentColor;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                    stroke-width: 1.7;
                }

                @media (prefers-reduced-motion: reduce) {
                    *:not(.loader__spinner), *:not(.loader__spinner)::before, *:not(.loader__spinner)::after {
                        scroll-behavior: auto !important;
                        transition-duration: 0.01ms !important;
                        animation-duration: 0.01ms !important;
                        animation-iteration-count: 1 !important;
                    }
                }
            </style>

</head>
<body>

    <a class="skip-link" href="#main-content">Skip to main content</a>

    <!-- Load shared components relative to this layout file. -->
    <?php include __DIR__ . '/../components/navbar.php'; ?>
    

    <main id="main-content">
        <!-- Render page content when the caller provides it. -->
        <?php echo $content ?? ''; ?>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>
    <script 
        src="<?php echo htmlspecialchars($siteAssets['leaflet_js'], ENT_QUOTES, 'UTF-8'); ?>"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin="">
    </script>
    <script>
        (function () {
            const mapElement = document.getElementById('footer-map');

            if (!mapElement || typeof L === 'undefined') return;

            const latitude = Number(mapElement.dataset.lat);
            const longitude = Number(mapElement.dataset.long);
            const zoom = Number(mapElement.dataset.zoom);

            if (!Number.isFinite(latitude) || !Number.isFinite(longitude) || !Number.isFinite(zoom)) return;

            const map = L.map(mapElement, {
                scrollWheelZoom: false,
                dragging: !L.Browser.mobile,
                touchZoom: true,
                doubleClickZoom: false,
            }).setView([latitude, longitude], zoom);

            const tileLayer = L.tileLayer(<?php echo json_encode($siteAssets['leaflet_tiles']); ?>, {
                maxZoom: 19,
                attribution: '&copy; <a href="<?php echo htmlspecialchars($siteAssets['openstreetmap_copyright'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">OpenStreetMap</a>',
            }).addTo(map);

            const mapLoader = document.getElementById('footer-map-loader');
            const hideMapLoader = () => {
                if (mapLoader) mapLoader.classList.add('is-hidden');
            };

            tileLayer.once('load', hideMapLoader);
            tileLayer.once('tileerror', hideMapLoader);

            const icon = L.icon({
                iconUrl: mapElement.dataset.icon,
                iconSize: [48, 48],
                iconAnchor: [24, 44],
                popupAnchor: [0, -42],
            });

            L.marker([latitude, longitude], { icon })
                .addTo(map)
                .bindPopup('I\'m here buddy');

            window.setTimeout(() => map.invalidateSize(), 150);
        }());
    </script>
</body>
</html>
