<?php
$pageTitle = 'Ronnie-Legaspi';
$pageDescription = 'Ronnie Legaspi is a backend-focused full-stack developer building secure APIs, Laravel systems, React applications, and reliable digital products.';
$indexLinks = [
    'github_profile' => 'https://github.com/LegaspiRonnie',
];
include_once __DIR__ . '/../components/icon.php';
ob_start();
?>

<section class="portfolio-hero">
    <div class="portfolio-hero__content">
        <p class="portfolio-hero__eyebrow"><span>•</span> Available for consulting &amp; projects</p>
        <h1>Ronnie Legaspi</h1>
        <p class="portfolio-hero__role">Backend Developer · API Integrations, Security &amp; Systems</p>
        <p class="portfolio-hero__text">
            I build secure APIs and reliable backend systems that turn complex requirements into practical products.
        </p>

        <div class="portfolio-hero__actions">
            <a href="projects.php" class="portfolio-hero__button portfolio-hero__button--primary">View My Work</a>
            <a href="book-schedule.php" class="portfolio-hero__button portfolio-hero__button--secondary">Get in Touch</a>
        </div>
    </div>

    <div class="portfolio-hero__visual">
        <div class="portfolio-hero__image-wrap">
            <img src="../../assets/images/profile.jpg" alt="Portrait of Ronnie Legaspi, backend developer" class="portfolio-hero__image" width="330" height="330" fetchpriority="high">
        </div>

        <div class="portfolio-hero__contrib-card">
            <div class="portfolio-hero__contrib-header">
                <span>GitHub contributions</span>
                <a href="<?php echo htmlspecialchars($indexLinks['github_profile'], ENT_QUOTES, 'UTF-8'); ?>" class="portfolio-hero__profile-link">View profile</a>
            </div>
            <div class="portfolio-hero__contrib-placeholder">
                <img
                    src="https://ghchart.rshah.org/LegaspiRonnie"
                    alt="GitHub contribution activity for Ronnie Legaspi"
                    loading="lazy"
                    class="portfolio-hero__contrib-image">
            </div>
        </div>
    </div>
</section>

<section class="portfolio-section">
    <div class="portfolio-section__heading">
        <p class="portfolio-section__eyebrow">What I do</p>
        <h2>Backend-first development with a full-stack perspective.</h2>
    </div>

    <div class="portfolio-grid">
        <article class="portfolio-card">
            <span class="portfolio-card__tag">APIs</span>
            <h3><?php echo portfolioIcon('api', 'API integrations'); ?>Reliable Integrations</h3>
            <p>REST APIs and third-party integrations that connect products, services, and useful data.</p>
        </article>

        <article class="portfolio-card">
            <span class="portfolio-card__tag">Backend</span>
            <h3><?php echo portfolioIcon('shield', 'Secure backend systems'); ?>Secure Systems</h3>
            <p>Laravel, Node.js, authentication, authorization, and maintainable logic for real workflows.</p>
        </article>

        <article class="portfolio-card">
            <span class="portfolio-card__tag">Data</span>
            <h3><?php echo portfolioIcon('database', 'Database foundations'); ?>Strong Foundations</h3>
            <p>MySQL, PostgreSQL, schema design, and query optimization that keep applications dependable.</p>
        </article>
    </div>
</section>

<section class="portfolio-section portfolio-section--split">
    <div class="portfolio-copy">
        <p class="portfolio-section__eyebrow">About Me</p>
        <h2>Practical technology, built with care.</h2>
        <p>
            I enjoy solving difficult problems through clean code, thoughtful interfaces, and systems that are
            secure, testable, and easy for teams to maintain.
        </p>
    </div>

    <div class="portfolio-focus">
        <div class="portfolio-focus__item">
            <strong>Problem solving</strong>
            <span>Debugging, testing, and clear technical decisions</span>
        </div>
        <div class="portfolio-focus__item">
            <strong>API focused</strong>
            <span>Integrations that connect products and services</span>
        </div>
        <div class="portfolio-focus__item">
            <strong>Team ready</strong>
            <span>Readable systems built for collaboration</span>
        </div>
    </div>
</section>

<style>
    .portfolio-hero {
        width: min(1180px, calc(100% - 2rem));
        margin: 0 auto;
        min-height: calc(100vh - 76px);
        display: grid;
        grid-template-columns: 1fr 1.15fr;
        gap: 2.2rem;
        align-items: center;
        padding: 2rem 0 3rem;
    }

    .portfolio-hero__content {
        min-height: 580px;
        padding: 1rem 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .portfolio-hero__eyebrow,
    .portfolio-section__eyebrow {
        margin: 0 0 0.9rem;
        font-size: 0.75rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #2563eb;
        font-weight: 700;
    }

    .portfolio-hero h1 {
        margin: 0;
        font-size: clamp(2.5rem, 5vw, 5rem);
        line-height: 0.98;
        letter-spacing: -0.06em;
        color: #111827;
    }

    .portfolio-hero__text {
        max-width: 660px;
        margin-top: 1.15rem;
        font-size: 1rem;
        line-height: 1.7;
        color: #5b6472;
    }

    .portfolio-hero__role {
        margin: 1rem 0 0;
        font-size: 1.12rem;
        line-height: 1.5;
        color: #64748b;
    }

    .portfolio-hero__actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .portfolio-hero__button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        padding: 0.95rem 1.5rem;
        font-weight: 700;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        text-decoration: none;
    }

    .portfolio-hero__button:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.12);
    }

    .portfolio-hero__button--primary {
        background: #2563eb;
        color: #fff;
    }

    .portfolio-hero__button--secondary {
        background: #eef4ff;
        color: #1d4ed8;
    }

    .portfolio-hero__visual {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.2rem;
    }

    .portfolio-hero__image-wrap {
        width: min(330px, 80vw);
        height: min(330px, 80vw);
        aspect-ratio: 1 / 1;
        border-radius: 50%;
        overflow: hidden;
        box-sizing: border-box;
        padding: 0.6rem;
        background: linear-gradient(135deg, #2563eb, #dbeafe);
        box-shadow: 0 18px 40px rgba(37, 99, 235, 0.14);
    }

    .portfolio-hero__image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
        border-radius: 50%;
        background: #f3f4f6;
    }

    .portfolio-hero__contrib-card {
        width: 100%;
        max-width: 620px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 22px;
        box-shadow: 0 18px 36px rgba(15, 23, 42, 0.06);
        padding: 1rem 1rem 0.85rem;
    }

    .portfolio-hero__contrib-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        margin-bottom: 0.8rem;
        font-weight: 700;
        color: #111827;
    }

    .portfolio-hero__contrib-header span {
        font-size: 0.96rem;
    }

    .portfolio-hero__profile-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.45rem 0.8rem;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        text-decoration: none;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 700;
    }

    .portfolio-hero__contrib-placeholder {
        width: 100%;
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        overflow: hidden;
        padding: 1rem;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
    }

    .portfolio-hero__contrib-image {
        display: block;
        width: 100%;
        max-width: 560px;
        height: auto;
        object-fit: contain;
    }

    .portfolio-section {
        width: min(1180px, calc(100% - 2rem));
        margin: 0 auto;
        padding: 2rem 0 4rem;
    }

    .portfolio-section__heading {
        margin-bottom: 1.5rem;
    }

    .portfolio-section__heading h2,
    .portfolio-copy h2 {
        margin: 0;
        color: #111827;
        font-size: clamp(1.9rem, 3vw, 2.7rem);
        line-height: 1.15;
        letter-spacing: -0.04em;
    }

    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1.25rem;
    }

    .portfolio-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 1.4rem;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
    }

    .portfolio-card__tag {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: 0.68rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        font-weight: 700;
        padding: 0.4rem 0.7rem;
        border-radius: 999px;
    }

    .portfolio-card h3 {
        margin: 1rem 0 0.7rem;
        color: #111827;
        font-size: 1.4rem;
    }

    .portfolio-card p,
    .portfolio-copy p,
    .portfolio-focus__item span {
        margin: 0;
        color: #5b6472;
        line-height: 1.75;
    }

    .portfolio-section--split {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 1.5rem;
        align-items: center;
    }

    .portfolio-copy {
        padding-right: 1rem;
    }

    .portfolio-focus {
        display: grid;
        gap: 1rem;
    }

    .portfolio-focus__item {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 1.1rem 1.2rem;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
    }

    .portfolio-focus__item strong {
        display: block;
        color: #111827;
        font-size: 1.05rem;
        margin-bottom: 0.25rem;
    }

    @media (max-width: 860px) {
        .portfolio-hero,
        .portfolio-section--split,
        .portfolio-grid {
            grid-template-columns: 1fr;
        }

        .portfolio-hero {
            min-height: auto;
            padding-top: 1.5rem;
        }

        .portfolio-hero__content {
            min-height: auto;
        }

        .portfolio-hero__panel {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php
$content = ob_get_clean();
include '../layout/layout.php';
?>
