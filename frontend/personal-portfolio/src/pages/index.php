<?php
$pageTitle = 'Ronnie-Legaspi';
ob_start();
?>

<section class="portfolio-hero">
    <div class="portfolio-hero__content">
        <p class="portfolio-hero__eyebrow">Software Engineer • Creative Problem Solver</p>
        <h1>Building thoughtful digital experiences.</h1>
        <p class="portfolio-hero__text">
            I design and build digital products that are practical, elegant, and user-focused.
            From front-end experiences to full project systems, I create work that balances function and clarity.
        </p>

        <div class="portfolio-hero__actions">
            <a href="projects.php" class="portfolio-hero__button portfolio-hero__button--primary">View Projects</a>
            <a href="book-schedule.php" class="portfolio-hero__button portfolio-hero__button--secondary">Book a Schedule</a>
        </div>
    </div>

    <div class="portfolio-hero__panel">
        <div class="portfolio-hero__stat">
            <strong>5+</strong>
            <span>Years building</span>
        </div>
        <div class="portfolio-hero__stat">
            <strong>20+</strong>
            <span>Projects shipped</span>
        </div>
        <div class="portfolio-hero__stat">
            <strong>100%</strong>
            <span>Focused on quality</span>
        </div>
    </div>
</section>

<section class="portfolio-section">
    <div class="portfolio-section__heading">
        <p class="portfolio-section__eyebrow">What I do</p>
        <h2>Thoughtful work across design, development, and delivery.</h2>
    </div>

    <div class="portfolio-grid">
        <article class="portfolio-card">
            <span class="portfolio-card__tag">Frontend</span>
            <h3>Responsive Interfaces</h3>
            <p>Clean, modern interfaces designed to feel intuitive and easy to use on every screen.</p>
        </article>

        <article class="portfolio-card">
            <span class="portfolio-card__tag">Backend</span>
            <h3>Reliable Systems</h3>
            <p>Scalable and maintainable application logic that supports real business needs.</p>
        </article>

        <article class="portfolio-card">
            <span class="portfolio-card__tag">Strategy</span>
            <h3>Product Thinking</h3>
            <p>Clear problem-solving and thoughtful product decisions from idea to launch.</p>
        </article>
    </div>
</section>

<section class="portfolio-section portfolio-section--split">
    <div class="portfolio-copy">
        <p class="portfolio-section__eyebrow">About Me</p>
        <h2>Designing digital work that feels human.</h2>
        <p>
            I enjoy building polished user experiences and practical systems that help people move faster,
            understand more, and feel confident using the tools they need every day.
        </p>
    </div>

    <div class="portfolio-focus">
        <div class="portfolio-focus__item">
            <strong>UX-first</strong>
            <span>Clear interfaces and smoother flows</span>
        </div>
        <div class="portfolio-focus__item">
            <strong>Performance</strong>
            <span>Fast, lean, efficient experiences</span>
        </div>
        <div class="portfolio-focus__item">
            <strong>Execution</strong>
            <span>From idea to working product</span>
        </div>
    </div>
</section>

<style>
    .portfolio-hero {
        width: min(1180px, calc(100% - 2rem));
        margin: 0 auto;
        min-height: calc(100vh - 76px);
        display: grid;
        grid-template-columns: 1.35fr 0.85fr;
        gap: 2rem;
        align-items: center;
        padding: 2rem 0 3rem;
    }

    .portfolio-hero__content {
        padding: 1rem 0;
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
        font-size: clamp(2.5rem, 6vw, 5rem);
        line-height: 0.98;
        letter-spacing: -0.06em;
        color: #111827;
    }

    .portfolio-hero__text {
        max-width: 660px;
        margin-top: 1.25rem;
        font-size: 1.06rem;
        line-height: 1.8;
        color: #4b5563;
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
        padding: 0.9rem 1.4rem;
        font-weight: 700;
        transition: transform 0.2s ease, background 0.2s ease;
    }

    .portfolio-hero__button:hover {
        transform: translateY(-1px);
    }

    .portfolio-hero__button--primary {
        background: #2563eb;
        color: #fff;
    }

    .portfolio-hero__button--secondary {
        background: #eef4ff;
        color: #1d4ed8;
    }

    .portfolio-hero__panel {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.06);
        padding: 1.25rem;
    }

    .portfolio-hero__stat {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 1.1rem 1rem;
        text-align: center;
    }

    .portfolio-hero__stat strong {
        display: block;
        font-size: 1.8rem;
        color: #111827;
        letter-spacing: -0.05em;
    }

    .portfolio-hero__stat span {
        display: block;
        margin-top: 0.35rem;
        color: #5b6472;
        font-size: 0.86rem;
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

        .portfolio-hero__panel {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php
$content = ob_get_clean();
include '../layout/layout.php';
?>
