<?php
$pageTitle = 'Projects';

// 2. Start buffering the HTML output
ob_start(); 
?>

<?php include __DIR__ . '/../components/projectCard.php'; ?>



<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/layout.php';
?>
