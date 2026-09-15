<?php
// 1. Set the browser title for the portfolio homepage.
$pageTitle = 'Ronnie-Legaspi';

// 2. Start buffering the HTML output
ob_start(); 
?>

<!-- Everything inside here is captured into the buffer -->
<h2>Ronnie's Portfolio</h2>
<p>This content belongs uniquely to the homepage!</p>

<?php 
// 3. Save the captured HTML into $content and clear the buffer
$content = ob_get_clean(); 

// 4. Load the master layout, which will now echo our $content
include '../layout/layout.php'; 
?>
