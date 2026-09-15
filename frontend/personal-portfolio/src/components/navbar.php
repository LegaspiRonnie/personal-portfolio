<style>
    /*
    ========================================
    CSS Custom Properties (Variables)
    ========================================
    Using variables makes it easy to customize the navbar's theme.
    */
    :root {
        --color-background: #ffffff;
        /* White background for a clean look */
        --color-foreground: #f8f9fa;
        /* A very light grey for subtle distinction if needed */
        --color-text: #333333;
        /* Dark grey for readable text, high contrast */
        --color-primary: #007bff;
        /* A standard, accessible blue for CTAs */
        --color-primary-hover: #0056b3;
        /* A darker blue for hover/focus states */
        --color-border-subtle: #e9ecef;
        /* Subtle border color */

        --font-family-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        --font-weight-normal: 400;
        --font-weight-bold: 700;

        --navbar-height: 70px;
        --navbar-padding: 1rem;
        --container-width: 1140px;

        --transition-speed: 0.2s;
    }

    /*
    ========================================
    Global Resets & Base Styles
    ========================================
    */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: var(--font-family-sans-serif);
        font-size: 1rem;
        font-weight: var(--font-weight-normal);
        line-height: 1.5;
        color: var(--color-text);
        background-color: var(--color-background);
    }

    /* Add some placeholder content to demonstrate scrolling */
    body::after {
        content: 'Scroll down to see the navbar is not sticky by default.';
        display: block;
        text-align: center;
        height: 200vh;
        padding-top: 5rem;
        color: #aaa;
    }

    /* Remove default list styles */
    ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    /* Basic link styling */
    a {
        text-decoration: none;
        color: var(--color-text);
    }

    /*
    ========================================
    Main Navbar Structure
    ========================================
    */
    .navbar {
        height: var(--navbar-height);
        display: flex;
        align-items: center;
        border-bottom: 1px solid var(--color-border-subtle);
        /* Keep the mobile dropdown positioned relative to the navbar. */
        position: relative;
    }

    .navbar__container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        max-width: var(--container-width);
        margin: 0 auto;
        padding: 0 var(--navbar-padding);
    }

    .navbar__brand {
        font-size: 1.5rem;
        font-weight: var(--font-weight-bold);
    }

    /*
    ========================================
    Mobile Menu & Hamburger Toggle
    ========================================
    This is the mobile-first approach.
    */
    .navbar__toggle {
        display: block;
        /* Shown on mobile */
        padding: 0.5rem;
        border: none;
        background: transparent;
        cursor: pointer;
        z-index: 1001;
        /* Ensure it's on top of menu */
    }

    /* Hamburger icon lines */
    .navbar__toggle .bar {
        display: block;
        width: 25px;
        height: 3px;
        margin: 5px auto;
        background-color: var(--color-text);
        transition: all var(--transition-speed) ease-in-out;
    }

    /* Hamburger animation to 'X' when active */
    .navbar__toggle.is-active .bar:nth-child(2) {
        opacity: 0;
    }

    .navbar__toggle.is-active .bar:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
    }

    .navbar__toggle.is-active .bar:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
    }

    .navbar__menu {
        display: none;
        /* Hidden by default on mobile */
        flex-direction: column;
        width: 100%;
        position: absolute;
        top: var(--navbar-height);
        left: 0;
        background-color: var(--color-background);
        border-bottom: 1px solid var(--color-border-subtle);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        z-index: 1000;
    }

    /* Show the menu when the .is-active class is present */
    .navbar__menu.is-active {
        display: flex;
    }

    .navbar__item {
        text-align: center;
        border-bottom: 1px solid var(--color-border-subtle);
    }

    .navbar__item:last-child {
        border-bottom: none;
    }

    .navbar__link {
        display: block;
        padding: 1.5rem;
        transition: background-color var(--transition-speed) ease;
    }

    .navbar__link:hover,
    .navbar__link:focus {
        background-color: var(--color-foreground);
    }

    /* Call to Action (CTA) Button - Mobile */
    .navbar__link--cta {
        color: var(--color-primary);
        font-weight: var(--font-weight-bold);
    }

    /* Use :focus-visible for a better accessibility experience. 
        This outline only shows for keyboard users, not mouse clicks. */
    :is(.navbar__toggle, .navbar__link):focus-visible {
        outline: 2px solid var(--color-primary);
        outline-offset: 2px;
        border-radius: 2px;
    }

    /*
    ========================================
    Desktop Navbar Styles (Responsive)
    ========================================
    Media query for screens 768px and wider.
    */
    @media (min-width: 768px) {
        .navbar__toggle {
            display: none;
            /* Hide the hamburger on desktop */
        }

        .navbar__menu {
            /* These properties are correct for the <nav> container */
            display: flex;
            align-items: center;
            position: static;
            width: auto;
            background-color: transparent;
            border: none;
            box-shadow: none;
        }

        .navbar__list {
            /* This makes the list items (<li>) arrange in a row */
            display: flex;
            align-items: center;
        }

        .navbar__item {
            /* Styles for individual list items are fine */
            border: none;
            margin-left: 0.5rem;
            /* Space between links */
        }

        .navbar__link {
            /* Adjusted styles for a horizontal layout */
            padding: 0.5rem 1rem;
            border-radius: 4px;
            /* Add a subtle bottom border for a clean underline effect */
            border-bottom: 2px solid transparent;
        }

        /* The classic "border on hover" effect */
        .navbar__link:not(.navbar__link--cta):hover,
        .navbar__link:not(.navbar__link--cta):focus {
            background-color: transparent;
            /* Override mobile hover */
            border-bottom-color: var(--color-primary);
            color: var(--color-text);
            /* Ensure text color remains consistent */
        }

        /* CTA Button Styling for Desktop */
        .navbar__item--cta {
            margin-left: 1.5rem;
        }

        .navbar__link--cta {
            color: #fff;
            /* White text on colored background */
            background-color: var(--color-primary);
            padding: 0.75rem 1.5rem;
            /* Make it more prominent */
            transition: background-color var(--transition-speed) ease;
            border-bottom: none;
            /* The CTA button doesn't need the bottom border */
        }

        /* CTA hover effect */
        .navbar__link--cta:hover,
        .navbar__link--cta:focus {
            background-color: var(--color-primary-hover);
            border-bottom: none;
            /* Ensure no border on hover either */
        }
    }
</style>
<header class="navbar" role="banner">
    <div class="navbar__container">
        <!-- Use the portfolio name as the responsive navbar brand. -->
        <a href="../index.php" class="navbar__brand">Ronnie-Legaspi</a>

        <!-- 
            This button controls the mobile navigation menu.
            - `aria-label` describes the button to screen readers.
            - `aria-controls` points to the ID of the menu it controls.
            - `aria-expanded` tells screen readers if the menu is open or closed.
        -->
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
                <li class="navbar__item"><a href="index.php" class="navbar__link">Home</a></li>
                <li class="navbar__item"><a href="profile.php" class="navbar__link">Profile</a></li>
                <li class="navbar__item"><a href="projects.php" class="navbar__link">Projects</a></li>
                <li class="navbar__item navbar__item--cta">
                    <a href="#contact" class="navbar__link navbar__link--cta">Contact Me</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<script>
    // A small, accessible script to toggle the mobile menu.
    document.addEventListener('DOMContentLoaded', function() {
        const navbarToggle = document.getElementById('navbarToggle');
        const navbarMenu = document.getElementById('navbarMenu');

        if (navbarToggle && navbarMenu) {
            navbarToggle.addEventListener('click', function() {
                // Toggle the .is-active class on both the toggle and the menu
                navbarToggle.classList.toggle('is-active');
                navbarMenu.classList.toggle('is-active');

                // Update the aria-expanded attribute
                const isExpanded = navbarToggle.getAttribute('aria-expanded') === 'true';
                navbarToggle.setAttribute('aria-expanded', !isExpanded);
            });

            // Close the mobile menu after a navigation link is selected.
            navbarMenu.querySelectorAll('.navbar__link').forEach(function(link) {
                link.addEventListener('click', function() {
                    navbarToggle.classList.remove('is-active');
                    navbarMenu.classList.remove('is-active');
                    navbarToggle.setAttribute('aria-expanded', 'false');
                });
            });

            // Allow keyboard users to close the mobile menu with Escape.
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    navbarToggle.classList.remove('is-active');
                    navbarMenu.classList.remove('is-active');
                    navbarToggle.setAttribute('aria-expanded', 'false');
                    navbarToggle.focus();
                }
            });
        }
    });
</script>