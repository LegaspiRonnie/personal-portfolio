<?php

$pages = [
    'index' => 'index.php',
    'profile' => 'profile.php',
    'projects' => 'projects.php',
    'contact' => 'contact.php',
    'book-schedule' => 'book-schedule.php',
];

$page = $_GET['page'] ?? 'index';

if (!is_string($page) || !isset($pages[$page])) {
    http_response_code(404);
    exit('Page not found.');
}

$_SERVER['SCRIPT_NAME'] = '/' . $pages[$page];

require __DIR__ . '/../personal-portfolio/src/pages/' . $pages[$page];