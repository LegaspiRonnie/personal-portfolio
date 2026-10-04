<?php

// Profile Page Metadata
$pageTitle = 'Dashboard' ?? "Ronnie Legaspi";

ob_start();
?>

<!-- Everything inside here is captured into the buffer -->
<div class="profile-page">
		 
</div>

 
<?php
    $content = ob_get_clean();
    include __DIR__ . '/layout/admin-layout.php';
?>
