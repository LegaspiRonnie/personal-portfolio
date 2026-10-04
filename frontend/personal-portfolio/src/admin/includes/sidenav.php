<?php
$adminNavItems = [
    'projects' => 'Projects',
    'visitors' => 'Visitors',
    'dashboard' => 'Dashboard',
    'messages' => 'Messages',
    'blogs' => 'Blogs',
    'insights' => 'Insights',
    'clients' => 'Clients',
    'schedule' => 'My Schedule',
    'experiences' => 'Experiences',
    'profile' => 'Profile',
    'logout' => 'Logout',
];
$activeAdminPage = $_GET['page'] ?? 'dashboard';
?>

<style>
    body {
        margin: 0;
        padding-left: 16rem;
        font-family: Arial, sans-serif;
    }

    .admin-sidebar {
        position: fixed;
        inset: 0 auto 0 0;
        z-index: 10;
        display: flex;
        width: 16rem;
        flex-direction: column;
        overflow-y: auto;
        box-sizing: border-box;
        padding: 1.5rem 1rem;
        background: #172033;
        color: #fff;
    }

    .admin-sidebar__brand {
        margin: 0 0 1.5rem;
        padding: 0 0.75rem;
        font-size: 1.15rem;
    }

    .admin-sidebar__nav {
        display: grid;
        gap: 0.35rem;
    }

    .admin-sidebar__link {
        display: block;
        padding: 0.7rem 0.75rem;
        border-radius: 0.4rem;
        color: #d7deeb;
        text-decoration: none;
    }

    .admin-sidebar__link:hover,
    .admin-sidebar__link:focus-visible,
    .admin-sidebar__link[aria-current="page"] {
        background: #2b3952;
        color: #fff;
    }

    .admin-sidebar__link--logout {
        margin-top: 1rem;
        color: #ffb4b4;
    }

    #main-content {
        min-height: calc(100vh - 5rem);
        padding: 2rem;
    }

    .admin-footer {
        padding: 1rem 2rem;
        color: #596579;
    }

    @media (max-width: 600px) {
        body {
            padding-left: 12rem;
        }

        .admin-sidebar {
            width: 12rem;
            padding: 1.25rem 0.75rem;
        }

        #main-content {
            padding: 1.25rem;
        }
    }
</style>

<aside class="admin-sidebar" aria-label="Admin sidebar">
    <h2 class="admin-sidebar__brand">Portfolio Admin</h2>
    <nav class="admin-sidebar__nav" aria-label="Admin navigation">
        <?php foreach ($adminNavItems as $slug => $label): ?>
            <a
                class="admin-sidebar__link<?php echo $slug === 'logout' ? ' admin-sidebar__link--logout' : ''; ?>"
                href="?page=<?php echo rawurlencode($slug); ?>"
                <?php echo $activeAdminPage === $slug ? 'aria-current="page"' : ''; ?>
            ><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></a>
        <?php endforeach; ?>
    </nav>
</aside>