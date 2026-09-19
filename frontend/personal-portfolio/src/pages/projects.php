<?php

$pageTitle = 'Projects';

// 2. Start buffering the HTML output
ob_start(); 
?>

<?php  ?>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">${projectTitle}</h2>
            <small>${projectCategory}</small>
        </div>
        <div class="card-body">
            <p>${projectDescription}</p>
        </div>
        <div class="card-footer">
            <small>${projectCreatedAt}</small>
            <a href="${projectPreviewLink}"><icon>View</icon></a>
            <a href="${projectGithubLink}"><icon>Github</icon></a>
        </div>
    </div>

    <script>
        const API_URL = 'http://localhost/personal-portfolio/backend/personal-portfolio/api/projects.php';
        
        async function loadProjects() {
            try {
                const response = fetch(API_URL, {
                                    method: "GET",
                                    headers:  {Accept: "application/json"}
                                });
            } catch (error) {
                
            }
        }
    </script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/layout.php';
?>
