<?php
$currentPage = basename(parse_url($_SERVER['PHP_SELF'] ?? '', PHP_URL_PATH));

function navbarLinkState(string $page, string $currentPage): string
{
    return $page === $currentPage ? ' is-active' : '';
}
?>

<style>
    :root {
        --color-background: #ffffff;
        --color-surface: #f8fafc;
        --color-soft: #eef4ff;
        --color-text: #111827;
        --color-muted: #5b6472;
        --color-primary: #2563eb;
        --color-primary-hover: #1d4ed8;
        --color-border: #e5e7eb;
        --shadow-soft: 0 10px 30px rgba(15, 23, 42, 0.08);
        --navbar-height: 76px;
        --container-width: 1180px;
        --transition-speed: 0.28s;
    }

    * {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        color: var(--color-text);
        background: #f5f7fb;
    }

    .skip-link {
        position: fixed;
        top: 0.75rem;
        left: 0.75rem;
        z-index: 2000;
        padding: 0.7rem 1rem;
        border-radius: 0.5rem;
        background: var(--color-text);
        color: #ffffff;
        transform: translateY(-150%);
        transition: transform var(--transition-speed) ease;
    }

    .skip-link:focus {
        transform: translateY(0);
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .navbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        height: var(--navbar-height);
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--color-border);
        box-shadow: 0 2px 16px rgba(15, 23, 42, 0.04);
        transform: translateY(0);
        transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
    }

    .navbar.is-hidden {
        transform: translateY(-110%);
        box-shadow: none;
    }

    .navbar__container {
        width: min(var(--container-width), calc(100% - 2rem));
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .navbar__brand {
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: -0.04em;
    }

    .navbar__toggle {
        display: block;
        padding: 0.5rem;
        border: 0;
        background: transparent;
        cursor: pointer;
    }

    .navbar__toggle .bar {
        display: block;
        width: 24px;
        height: 2px;
        background: var(--color-text);
        margin: 5px 0;
        border-radius: 999px;
        transition: all var(--transition-speed) ease;
    }

    .navbar__toggle.is-active .bar:nth-child(2) {
        opacity: 0;
    }

    .navbar__toggle.is-active .bar:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
    }

    .navbar__toggle.is-active .bar:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
    }

    .navbar__menu {
        display: none;
        position: absolute;
        top: var(--navbar-height);
        left: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.98);
        border-bottom: 1px solid var(--color-border);
        box-shadow: var(--shadow-soft);
    }

    .navbar__menu.is-active {
        display: block;
    }

    .navbar__item {
        border-bottom: 1px solid var(--color-border);
    }

    .navbar__item:last-child {
        border-bottom: none;
    }

    .navbar__link {
        display: block;
        padding: 1rem 1.25rem;
        font-size: 0.96rem;
        font-weight: 600;
        color: var(--color-text);
        transition: background var(--transition-speed) ease, color var(--transition-speed) ease;
    }

    .navbar__link:hover,
    .navbar__link:focus {
        background: var(--color-surface);
    }

    .navbar__link.is-active {
        color: var(--color-primary-hover);
        background: var(--color-soft);
    }

    .navbar__link--cta {
        color: #fff;
        background: var(--color-primary);
        border-radius: 999px;
        margin: 0.75rem 1rem 1rem;
        text-align: center;
        font-weight: 700;
    }

    .navbar__link--cta:hover,
    .navbar__link--cta:focus {
        background: var(--color-primary-hover);
    }

    .navbar__link--cta.is-active {
        color: #ffffff;
        background: var(--color-primary-hover);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.16);
    }

    @media (min-width: 840px) {
        .navbar__toggle {
            display: none;
        }

        .navbar__menu {
            display: flex;
            position: static;
            width: auto;
            background: transparent;
            border: none;
            box-shadow: none;
        }

        .navbar__list {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar__item {
            border: none;
        }

        .navbar__link {
            padding: 0.7rem 1rem;
            border-radius: 999px;
        }

        .navbar__link:not(.navbar__link--cta):hover,
        .navbar__link:not(.navbar__link--cta):focus {
            background: var(--color-soft);
        }

        .navbar__link--cta {
            margin: 0;
            padding: 0.8rem 1.2rem;
        }
    }
</style>

<header class="navbar" role="banner" id="siteNavbar">
    <div class="navbar__container">
        <a href="index.php" class="navbar__brand" aria-label="Ronnie Legaspi home">Ronnie-Legaspi</a>

        <button class="navbar__toggle"
            id="navbarToggle"
            type="button"
            aria-label="Toggle navigation"
            aria-controls="navbarMenu"
            aria-expanded="false">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>

        <nav id="navbarMenu" class="navbar__menu" role="navigation" aria-labelledby="navbarToggle">
            <ul class="navbar__list">
                <li class="navbar__item"><a href="index.php" class="navbar__link<?php echo navbarLinkState('index.php', $currentPage); ?>"<?php echo $currentPage === 'index.php' ? ' aria-current="page"' : ''; ?>>Home</a></li>
                <li class="navbar__item"><a href="profile.php" class="navbar__link<?php echo navbarLinkState('profile.php', $currentPage); ?>"<?php echo $currentPage === 'profile.php' ? ' aria-current="page"' : ''; ?>>Profile</a></li>
                <li class="navbar__item"><a href="projects.php" class="navbar__link<?php echo navbarLinkState('projects.php', $currentPage); ?>"<?php echo $currentPage === 'projects.php' ? ' aria-current="page"' : ''; ?>>Projects</a></li>
                <li class="navbar__item"><a href="contact.php" class="navbar__link<?php echo navbarLinkState('contact.php', $currentPage); ?>"<?php echo $currentPage === 'contact.php' ? ' aria-current="page"' : ''; ?>>Contact Me</a></li>
                <li class="navbar__item">
                    <a href="book-schedule.php" class="navbar__link navbar__link--cta<?php echo navbarLinkState('book-schedule.php', $currentPage); ?>"<?php echo $currentPage === 'book-schedule.php' ? ' aria-current="page"' : ''; ?>>Book a Schedule</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.getElementById('siteNavbar');
        const navbarToggle = document.getElementById('navbarToggle');
        const navbarMenu = document.getElementById('navbarMenu');

        if (navbarToggle && navbarMenu) {
            navbarToggle.addEventListener('click', function () {
                const isExpanded = navbarToggle.getAttribute('aria-expanded') === 'true';
                navbarToggle.setAttribute('aria-expanded', String(!isExpanded));
                navbarToggle.classList.toggle('is-active', !isExpanded);
                navbarMenu.classList.toggle('is-active', !isExpanded);
            });

            navbarMenu.querySelectorAll('.navbar__link').forEach(function (link) {
                link.addEventListener('click', function () {
                    navbarToggle.classList.remove('is-active');
                    navbarMenu.classList.remove('is-active');
                    navbarToggle.setAttribute('aria-expanded', 'false');
                });
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    navbarToggle.classList.remove('is-active');
                    navbarMenu.classList.remove('is-active');
                    navbarToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }

        if (navbar) {
            let lastScrollY = window.scrollY;
            let hideTimer = null;

            function updateNavbarState() {
                const currentY = window.scrollY;
                const isScrollingDown = currentY > lastScrollY && currentY > 60;

                if (isScrollingDown) {
                    navbar.classList.add('is-hidden');
                } else {
                    navbar.classList.remove('is-hidden');
                }

                lastScrollY = currentY;
            }

            window.addEventListener('scroll', function () {
                updateNavbarState();
                clearTimeout(hideTimer);

                hideTimer = setTimeout(function () {
                    if (window.scrollY > 20) {
                        navbar.classList.add('is-hidden');
                    }
                }, 1000);
            }, { passive: true });
        }
    });
</script>