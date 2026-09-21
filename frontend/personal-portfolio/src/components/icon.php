<?php
if (!function_exists('portfolioIcon')) {
    function portfolioIcon(string $name, string $title): string
    {
        $paths = [
            'code' => '<path d="M8 9 4 12l4 3m8-6 4 3-4 3m-5 3 2-12" />',
            'api' => '<path d="M4 7h16M4 12h16M4 17h10" /><circle cx="18" cy="17" r="2" />',
            'database' => '<ellipse cx="12" cy="5" rx="7" ry="3" /><path d="M5 5v7c0 1.7 3.1 3 7 3s7-1.3 7-3V5m-14 7v7c0 1.7 3.1 3 7 3s7-1.3 7-3v-7" />',
            'shield' => '<path d="m12 3 7 3v5c0 4.5-3 8.1-7 10-4-1.9-7-5.5-7-10V6l7-3zM9 12l2 2 4-4" />',
            'calendar' => '<rect x="4" y="5" width="16" height="15" rx="2" /><path d="M8 3v4m8-4v4M4 10h16" />',
            'briefcase' => '<rect x="3" y="7" width="18" height="13" rx="2" /><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m-13 5h18" />',
            'mail' => '<path d="M3 5h18v14H3zM3 6l9 7 9-7" />',
            'phone' => '<path d="M6 3h4l2 5-2.5 1.5a15 15 0 0 0 5 5L16 12l5 2v4c0 1.1-.9 2-2 2C10.7 20 4 13.3 4 5c0-1.1.9-2 2-2z" />',
        ];

        $path = $paths[$name] ?? $paths['code'];
        $safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

        return '<span class="portfolio-icon" title="' . $safeTitle . '" aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false">' . $path . '</svg></span>';
    }
}
