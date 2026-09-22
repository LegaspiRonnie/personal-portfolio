<?php
require_once __DIR__ . '/../config/data.php';
// Profile Page Metadata
$pageTitle = $pageMetadata['profile']['title'];
$pageDescription = $pageMetadata['profile']['description'];
include_once __DIR__ . '/../components/icon.php';

ob_start();
?>

<!-- Everything inside here is captured into the buffer -->
<div class="profile-page">
		 <section class="profile-intro">
		 <div>
			 <p class="profile-eyebrow">Profile</p>
			 <h1>Full-stack thinking with a backend focus.</h1>
			 <p class="profile-lead">
				 Results-driven Full-Stack Web Developer and IT graduate building reliable web applications,
				 REST APIs, and practical digital systems.
			 </p>
		 </div>
		 <div class="profile-contact">
			 <span>Currently open to</span>
			 <strong>Web Development · Software Engineering · IT Support</strong>
				 <a href="mailto:<?php echo htmlspecialchars($siteContact['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($siteContact['email'], ENT_QUOTES, 'UTF-8'); ?></a>
				 <a href="tel:<?php echo htmlspecialchars($siteContact['phone'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($siteContact['phone'], ENT_QUOTES, 'UTF-8'); ?></a>
		 </div>
	 </section>
 
	 <section class="profile-section">
		 <div class="profile-section-heading">
			 <p class="profile-eyebrow">Technical toolkit</p>
			 <h2>Tools I use to turn requirements into working products.</h2>
		 </div>
 
		 <div class="skill-grid">
			 <article class="skill-card">
				 <span class="skill-card__number">01</span>
				 <h3><?php echo portfolioIcon('code', 'Backend development'); ?>Backend Development</h3>
				 <p>Node.js, Express.js, PHP, Laravel, RESTful API engineering, authentication, authorization, Sanctum, and policies.</p>
			 </article>
			 <article class="skill-card">
				 <span class="skill-card__number">02</span>
				 <h3><?php echo portfolioIcon('code', 'Frontend development'); ?>Frontend Development</h3>
				 <p>React.js, Vue.js, Inertia.js, TypeScript, JavaScript ES6+, Tailwind CSS, Bootstrap, HTML5, and CSS3.</p>
			 </article>
			 <article class="skill-card">
				 <span class="skill-card__number">03</span>
				 <h3><?php echo portfolioIcon('database', 'Databases and storage'); ?>Data &amp; Storage</h3>
				 <p>MySQL, PostgreSQL, SQLite, relational database modeling, schema design, and query optimization.</p>
			 </article>
			 <article class="skill-card">
				 <span class="skill-card__number">04</span>
				 <h3><?php echo portfolioIcon('briefcase', 'Tools and workflow'); ?>Tools &amp; Workflow</h3>
				 <p>Git, GitHub, Docker, XAMPP, WampServer, VS Code, basic Linux CLI, and AI-assisted development workflows.</p>
			 </article>
		 </div>
	 </section>
 
	 <section class="profile-section profile-section--experience">
		 <div class="profile-section-heading">
			 <p class="profile-eyebrow">Experience</p>
			 <h2>Work shaped by shipping, debugging, and improving.</h2>
		 </div>
 
		 <div class="experience-list">
			 <article class="experience-item">
				 <div class="experience-date">Apr 2026 — Jul 2026</div>
				 <div>
					 <h3>KooApps <span>Backend Developer</span></h3>
					 <p>Developed and maintained full-stack applications using Laravel, React.js, REST APIs, and MySQL. Integrated third-party APIs, fixed bugs, and optimized database queries for reliability and performance.</p>
				 </div>
			 </article>
			 <article class="experience-item">
				 <div class="experience-date">Apr 2026 — Jul 2026</div>
				 <div>
					 <h3>AeonSprint Solutions Inc. <span>Junior Web Developer</span></h3>
					 <p>Built and maintained full-stack features, integrated APIs, resolved defects, and improved database-backed workflows with Laravel, React.js, and MySQL.</p>
				 </div>
			 </article>
			 <article class="experience-item">
				 <div class="experience-date">Feb 2026 — Apr 2026</div>
				 <div>
					 <h3>AeonSprint Solutions Inc. <span>Junior Web Developer Intern</span></h3>
					 <p>Developed Laravel, Vue.js, and React.js features including APIs, database design, and NFC attendance systems. Contributed through testing, refactoring, UX improvements, and technical collaboration.</p>
				 </div>
			 </article>
			 <article class="experience-item">
				 <div class="experience-date">Jun 2025 — Present</div>
				 <div>
					 <h3>Freelance Projects <span>Web Developer</span></h3>
					 <p>Delivered custom websites and web applications for freelance, portfolio, and research projects based on client requirements and project goals.</p>
				 </div>
			 </article>
		 </div>
	 </section>
</div>
 
 <style>
	 .profile-page {
		 width: min(1180px, calc(100% - 2rem));
		 margin: 0 auto;
		 padding: 5rem 0 6rem;
		 color: #111827;
	 }
 
	.profile-intro {
		 display: grid;
		 grid-template-columns: 1.2fr 0.8fr;
		 gap: 4rem;
		 align-items: end;
		 padding-bottom: 4rem;
		 border-bottom: 1px solid #e5e7eb;
	 }
 
	 .profile-eyebrow {
		 margin: 0 0 1rem;
		 color: #2563eb;
		 font-size: 0.72rem;
		 font-weight: 700;
		 letter-spacing: 0.14em;
		 text-transform: uppercase;
	 }
 
	.profile-intro h1 {
		 max-width: 760px;
		 margin: 0;
		 font-size: clamp(2.8rem, 6vw, 5.8rem);
		 line-height: 0.96;
		 letter-spacing: -0.07em;
	 }
 
	 .profile-lead {
		 max-width: 650px;
		 margin: 1.5rem 0 0;
		 color: #5b6472;
		 font-size: 1.1rem;
		 line-height: 1.75;
	 }
 
	 .profile-contact {
		 display: grid;
		 gap: 0.7rem;
		 padding: 1.5rem;
		 border-left: 2px solid #2563eb;
		 background: #f8fafc;
	 }
 
	 .profile-contact span {
		 color: #64748b;
		 font-size: 0.78rem;
		 text-transform: uppercase;
		 letter-spacing: 0.1em;
	 }
 
	 .profile-contact strong { line-height: 1.45; }
	 .profile-contact a { color: #2563eb; }
 
	 .profile-section { padding: 5rem 0 0; }
	 .profile-section-heading { max-width: 660px; margin-bottom: 2rem; }
	 .profile-section h2 { margin: 0; font-size: clamp(2rem, 4vw, 3.4rem); line-height: 1; letter-spacing: -0.06em; }
 
	 .skill-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1rem; }
	 .skill-card { min-height: 240px; padding: 1.35rem; border: 1px solid #e5e7eb; background: #fff; }
	 .skill-card__number { color: #2563eb; font-size: 0.75rem; font-weight: 700; }
	 .skill-card h3 { margin: 3.5rem 0 0.7rem; font-size: 1.15rem; }
	 .skill-card p, .experience-item p { margin: 0; color: #5b6472; line-height: 1.7; }
 
	 .profile-section--experience { padding-bottom: 2rem; }
	 .experience-list { border-top: 1px solid #e5e7eb; }
	 .experience-item { display: grid; grid-template-columns: 190px 1fr; gap: 2rem; padding: 1.5rem 0; border-bottom: 1px solid #e5e7eb; }
	 .experience-date { color: #2563eb; font-size: 0.82rem; font-weight: 700; }
	 .experience-item h3 { margin: 0 0 0.55rem; font-size: 1.25rem; }
	 .experience-item h3 span { color: #64748b; font-weight: 400; }
 
	 @media (max-width: 860px) {
		 .profile-page { padding-top: 3rem; }
		 .profile-intro, .skill-grid { grid-template-columns: 1fr 1fr; gap: 1rem; }
		 .profile-intro { grid-template-columns: 1fr; gap: 2rem; }
	 }
 
	 @media (max-width: 560px) {
		 .skill-grid, .experience-item { grid-template-columns: 1fr; }
		 .experience-item { gap: 0.5rem; }
	 }
 </style>
 
 <?php
 $content = ob_get_clean();
include __DIR__ . '/../layout/layout.php';
?>
