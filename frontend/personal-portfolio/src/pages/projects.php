<?php

require_once __DIR__ . '/../config/data.php';
$pageTitle = $pageMetadata['projects']['title'];
$pageDescription = $pageMetadata['projects']['description'];

include_once __DIR__ . '/../components/icon.php';
ob_start();
?>

<div class="projects-page">
    <section class="projects-intro">
         <p class="projects-eyebrow">Selected work</p>
         <h1>Systems built to solve real problems.</h1>
         <p>From civic technology to employee workflows and event operations, these projects combine reliable backend logic with thoughtful interfaces.</p>
     </section>
 
     <section class="project-list">
         <article class="project-feature">
             <div class="project-feature__meta"><span>01</span><span><?php echo portfolioIcon('shield', 'Secure civic technology'); ?>Laravel 12 · React · TypeScript · MySQL</span></div>
             <div class="project-feature__body">
                 <div>
                     <p class="projects-eyebrow">Civic technology</p>
                     <h2>Smart Barangay Incident Reporting System</h2>
                 </div>
                 <div>
                     <p>SBIRS helps communities report, track, and resolve incidents through a centralized web application.</p>
                     <ul>
                         <li>Incident reporting with photo uploads and map location tagging</li>
                         <li>Secure authentication, authorization, and QR-based guest reporting</li>
                         <li>Audit logs and resolution tracking dashboards</li>
                     </ul>
                     <div class="project-feature__links">
                        <a href="<?php echo htmlspecialchars($projectLinks['sbirs'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo portfolioIcon('briefcase', 'Open the Noter project'); ?>View project
                        </a>
                </div>
                 </div>
             </div>
         </article>
 
         <article class="project-feature">
             <div class="project-feature__meta"><span>02</span><span><?php echo portfolioIcon('api', 'Workflow automation'); ?>Laravel · React · MySQL · Tailwind CSS · Docker</span></div>
             <div class="project-feature__body">
                 <div>
                     <p class="projects-eyebrow">Workflow automation</p>
                     <h2>HRFlow</h2>
                 </div>
                 <div>
                     <p>An HR management system that makes employee document requests and approvals easier to manage.</p>
                     <ul>
                         <li>Role-based document workflows and approval tracking</li>
                         <li>PDF generation and email notifications</li>
                         <li>Centralized document status and history</li>
                     </ul>
                     <div class="project-feature__links">
                        <a href="<?php echo htmlspecialchars($projectLinks['hrflow'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo portfolioIcon('briefcase', 'Open the Noter project'); ?>View project
                        </a>
                </div>
                 </div>
             </div>
         </article>
 
         <article class="project-feature">
             <div class="project-feature__meta"><span>03</span><span><?php echo portfolioIcon('calendar', 'Events and attendance'); ?>Laravel · MySQL · React</span></div>
             <div class="project-feature__body">
                 <div>
                     <p class="projects-eyebrow">Events & attendance</p>
                     <h2>BadgerMint</h2>
                 </div>
                 <div>
                     <p>An event and attendance management platform designed to make registration and event monitoring more efficient.</p>
                     <ul>
                         <li>Event registration and attendance logging workflows</li>
                         <li>Scalable backend logic for attendee analytics</li>
                         <li>Clear operational views for event monitoring</li>
                     </ul>
                     <div class="project-feature__links">
                        <a href="<?php echo htmlspecialchars($projectLinks['badgermint'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo portfolioIcon('briefcase', 'Open the Noter project'); ?>View project
                        </a>
                </div>
                 </div>
             </div>
         </article>
         <article class="project-feature">
             <div class="project-feature__meta"><span>04</span><span><?php echo portfolioIcon('note', 'Notes and organization'); ?>PHP · MySQL · JavaScript · CSS</span></div>
             <div class="project-feature__body">
                 <div>
                     <p class="projects-eyebrow">Personal organization</p>
                     <h2>Noter</h2>
                 </div>
                 <div>
                     <p>A focused note-taking application for capturing ideas, organizing content, and finding important notes quickly.</p>
                     <ul>
                         <li>Create and edit notes with titles, descriptions, and links</li>
                         <li>Group notes by category and filter them when needed</li>
                         <li>Manage notes through a clear, responsive interface</li>
                     </ul>
                     <div class="project-feature__links">
                        <a href="<?php echo htmlspecialchars($projectLinks['noter'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo portfolioIcon('briefcase', 'Open the Noter project'); ?>View project
                        </a>
                </div>
                 </div>
                 
             </div>
             
         </article>
         <article class="project-feature">
             <div class="project-feature__meta"><span>04</span><span><?php echo portfolioIcon('note', 'Notes and organization'); ?>PHP · MySQL · JavaScript · CSS</span></div>
             <div class="project-feature__body">
                 <div>
                     <p class="projects-eyebrow">Personal organization</p>
                     <h2>Api-Hub</h2>
                 </div>
                 <div>
                     <p>A focused note-taking application for capturing ideas, organizing content, and finding important notes quickly.</p>
                     <ul>
                         <li>Create and edit notes with titles, descriptions, and links</li>
                         <li>Group notes by category and filter them when needed</li>
                         <li>Manage notes through a clear, responsive interface</li>
                     </ul>
                     <div class="project-feature__links">
                        <a href="<?php echo htmlspecialchars($projectLinks['api_hub'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo portfolioIcon('briefcase', 'Open the Noter project'); ?>View project
                        </a>
                </div>
                 </div>
                 
             </div>
             
         </article>
     </section>
</div>
 
 <style>
     .projects-page { width: min(1180px, calc(100% - 2rem)); margin: 0 auto; padding: 5rem 0 7rem; }
    .projects-intro { max-width: 820px; padding-bottom: 2.5rem; border-bottom: 1px solid #e5e7eb; }
     .projects-eyebrow { margin: 0 0 1rem; color: #2563eb; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; }
    .projects-intro h1 { margin: 0; font-size: clamp(2.5rem, 6vw, 5rem); line-height: 0.94; letter-spacing: -0.07em; }
    .projects-intro > p:last-child { max-width: 650px; margin: 1.25rem 0 0; color: #5b6472; font-size: 1.05rem; line-height: 1.7; }
     .project-list { display: grid; gap: 1rem; padding-top: 3rem; }
     .project-feature { padding: 1.5rem 0 2.5rem; border-bottom: 1px solid #e5e7eb; }
     .project-feature__meta { display: flex; justify-content: space-between; gap: 1rem; color: #64748b; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.08em; }
     .project-feature__meta span:first-child { color: #2563eb; font-weight: 700; }
     .project-feature__body { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; margin-top: 2rem; }
     .project-feature h2 { max-width: 520px; margin: 0; font-size: clamp(2rem, 4vw, 4rem); line-height: 0.98; letter-spacing: -0.07em; }
     .project-feature p:not(.projects-eyebrow) { margin: 0; color: #5b6472; line-height: 1.75; }
     .project-feature ul { display: grid; gap: 0.65rem; margin: 1.4rem 0 0; padding: 0; list-style: none; }
     .project-feature li { padding-left: 1.2rem; color: #111827; line-height: 1.5; position: relative; }
     .project-feature li::before { content: ''; position: absolute; left: 0; top: 0.65em; width: 5px; height: 5px; border-radius: 50%; background: #2563eb; }
    .project-feature__links { margin-top: 1.5rem; }
    .project-feature__links a { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.7rem 1rem; border-radius: 999px; background: #eff6ff; color: #1d4ed8; font-weight: 700; text-decoration: none; }
     @media (max-width: 700px) {
         .projects-page { padding-top: 3rem; }
         .project-feature__meta, .project-feature__body { display: block; }
         .project-feature__meta span:last-child { display: block; margin-top: 0.5rem; }
         .project-feature__body > div + div { margin-top: 1.5rem; }
     }
 </style>
 
 <?php
 $content = ob_get_clean();
include __DIR__ . '/../layout/layout.php';
?>
