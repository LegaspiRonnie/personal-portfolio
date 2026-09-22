<?php

// Portfolio Page Metadata
$pageMetadata = [
    'home' => [
        'title' => 'Ronnie-Legaspi',
        'description' => 'Ronnie Legaspi is a backend-focused full-stack developer building secure APIs, Laravel systems, React applications, and reliable digital products.',
    ],
    'profile' => [
        'title' => 'Profile | Ronnie Legaspi',
        'description' => 'Learn about Ronnie Legaspi, a full-stack web developer and IT graduate experienced with Laravel, PHP, React, REST APIs, databases, and secure systems.',
    ],
    'projects' => [
        'title' => 'Projects | Ronnie Legaspi',
        'description' => 'Explore Ronnie Legaspi\'s selected projects, including a civic incident reporting system, HR workflow automation, and event attendance management platform.',
    ],
    'contact' => [
        'title' => 'Contact | Ronnie Legaspi',
        'description' => 'Contact Ronnie Legaspi about backend development, Laravel and React applications, API integrations, software engineering, and technical consulting.',
    ],
    'book_schedule' => [
        'title' => 'Book a Schedule | Ronnie Legaspi',
        'description' => 'View Ronnie Legaspi\'s availability and schedule a conversation about web development, backend systems, API integrations, or consulting.',
    ],
];

// Home Page Links and API Metadata
$indexLinks = [
    'github_contributions' => 'https://ghchart.rshah.org/LegaspiRonnie',
    'jobdocs_roadmap' => 'https://jobdocs-roadmap.vercel.app/',
    'jobdocs_roadmap_video' => 'https://youtu.be/XVlfLsdsafs',
    'jobdocs_video_embed' => 'https://www.youtube.com/embed/XVlfLsdsafs?si=xCU8tVAV54RDwijq&enablejsapi=1&autoplay=0&mute=1&playsinline=1',
];

$indexApi = [
    'weather' => [
        'url' => '/personal-portfolio/backend/projects/api-hub/api/weather.php',
        'city' => 'Manila',
    ],
    'youtube_origin' => 'https://www.youtube.com',
];

// Site-wide Metadata
$siteMetadata = [
    'author' => 'Ronnie Hortizuela Legaspi',
    'site_name' => 'Ronnie Legaspi Portfolio',
    'site_url' => 'https://ronnie-legaspi-portfolio.vercel.app',
];

// Site-wide Social Links
$siteLinks = [
    'github_profile' => 'https://github.com/LegaspiRonnie',
    'linkedin_profile' => 'https://www.linkedin.com/in/legaspi-ronnie-h-385690347/',
];

// Site-wide Contact Metadata
$siteContact = [
    'email' => 'ronnielegaspi98@gmail.com',
    'phone' => '+639930954435',
    'location' => 'Villegas Poruk 1-a, Pozorrubio, Pangasinan',
];

// Project Page Links

$projectLinks = [
    'sbirs' => 'https://smart-barangay-incident-reporting-s.vercel.app/',
    'hrflow' => 'https://hr-flow-employee-document-workflow.vercel.app/',
    'badgermint' => 'https://badgermint.app/',
    'noter' => 'http://localhost/personal-portfolio/frontend/projects/noter/',
    'api_hub' => 'http://localhost/personal-portfolio/frontend/projects/api-hub/',
];

// Booking Page Links
$bookingLinks = [
    'calendar_embed' => 'https://calendar.google.com/calendar/embed?' . http_build_query([
        'src' => $siteContact['email'],
        'ctz' => 'Asia/Manila',
        'mode' => 'WEEK',
    ]),
];

// Footer Social Links and Map Metadata
$footerLinks = [
    'github' => $siteLinks['github_profile'],
    'linkedin' => $siteLinks['linkedin_profile'],
    'instagram' => 'https://www.facebook.com/ronniehortizuela.legaspi',
    'facebook' => 'https://www.facebook.com/ron_aint_simp.23/',
    'youtube' => 'https://www.youtube.com/@ronnielegaspi4731',
];

$footerLocation = [
    'label' => $siteContact['location'],
    'long' => 120.558655,
    'lat' => 16.127258,
    'zoom' => 12,
    'icon' => '../../assets/images/loc-icon.png',
];

// Portfolio Internal Page Links
$sitePages = [
    'home' => 'index.php',
    'profile' => 'profile.php',
    'projects' => 'projects.php',
    'contact' => 'contact.php',
    'book_schedule' => 'book-schedule.php',
];

// Shared External Asset URLs
$siteAssets = [
    'font_awesome_css' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
    'leaflet_css' => 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
    'leaflet_js' => 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
    'leaflet_tiles' => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    'openstreetmap_copyright' => 'https://www.openstreetmap.org/copyright',
    'unpkg_preconnect' => 'https://unpkg.com',
    'tile_preconnect' => 'https://tile.openstreetmap.org',
];

return [
    'pageMetadata' => $pageMetadata,
    'indexLinks' => $indexLinks,
    'indexApi' => $indexApi,
    'siteMetadata' => $siteMetadata,
    'siteLinks' => $siteLinks,
    'siteContact' => $siteContact,
    'projectLinks' => $projectLinks,
    'bookingLinks' => $bookingLinks,
    'footerLinks' => $footerLinks,
    'footerLocation' => $footerLocation,
    'sitePages' => $sitePages,
    'siteAssets' => $siteAssets,
];
