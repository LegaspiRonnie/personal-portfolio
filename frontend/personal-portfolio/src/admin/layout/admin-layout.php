<?php
$initialize = require dirname(__DIR__) . '/config/initialize.php';
// print_r($initialize);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    // Load the frontend environment so the application title can come from frontend/.env.
    require_once $initialize['base'] . '/vendor/autoload.php';

    Dotenv\Dotenv::createImmutable(dirname(__DIR__, 3))->safeLoad();

    ?>  
    

    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    
</head>
<body>

    <a class="skip-link" href="#main-content">Skip to main content</a>

    <!-- Load shared components relative to this layout file. -->
    <?php include $initialize['includes'] . '/sidenav.php'; ?>
    

    <main id="main-content">
        <!-- Render page content when the caller provides it. -->
        <?php echo $content ?? ''; ?>
    
    </main>

    <?php include $initialize['includes'] . '/footer.php'; ?>
    

</body>
</html>
