<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
    // Load the frontend environment so the application title can come from frontend/.env.
    require_once dirname(__DIR__, 3) . '/vendor/autoload.php';
    Dotenv\Dotenv::createImmutable(dirname(__DIR__, 3))->safeLoad();
    ?>
    <!-- Use the page title first, then the configured app title, with a safe fallback. -->
    <title><?php echo htmlspecialchars($pageTitle ?? $_ENV['APP_TITLE'] ?? 'Ronnie-Legaspi', ENT_QUOTES, 'UTF-8'); ?></title>
</head>
<body>

    <!-- Load shared components relative to this layout file. -->
    <?php include __DIR__ . '/../components/navbar.php'; ?>

    <main>
        <!-- Render page content when the caller provides it. -->
        <?php echo $content ?? ''; ?>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>

</body>
</html>
