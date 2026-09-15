<style>
    .projects-grid {
        display: grid;
        gap: 24px;
        grid-template-columns: repeat(auto-fit, minmax(min(100%, 520px), 1fr));
        margin: 32px auto;
        max-width: 1180px;
        padding: 0 20px;
    }

    .project-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        display: flex;
        min-height: 230px;
        overflow: hidden;
    }

    .project-card__image {
        background: #e2e8f0;
        flex: 0 0 38%;
        min-height: 230px;
        object-fit: cover;
        width: 38%;
    }

    .project-card__image--empty {
        align-items: center;
        color: #64748b;
        display: flex;
        font-size: 0.8rem;
        justify-content: center;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .project-card__content {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 24px;
    }

    .project-card__category {
        color: #2563eb;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        margin: 0 0 8px;
        text-transform: uppercase;
    }

    .project-card__title {
        color: #172033;
        font-size: 1.35rem;
        line-height: 1.2;
        margin: 0 0 12px;
    }

    .project-card__description {
        color: #475569;
        flex: 1;
        line-height: 1.55;
        margin: 0 0 20px;
    }

    .project-card__link {
        align-self: flex-start;
        background: #172033;
        border-radius: 6px;
        color: #ffffff;
        font-size: 0.9rem;
        font-weight: 600;
        padding: 10px 16px;
        text-decoration: none;
    }

    .project-card__link:hover,
    .project-card__link:focus-visible {
        background: #2563eb;
    }

    .projects-message {
        color: #475569;
        margin: 40px auto;
        padding: 0 20px;
        text-align: center;
    }

    @media (max-width: 600px) {
        .project-card {
            flex-direction: column;
        }

        .project-card__image {
            flex-basis: 180px;
            min-height: 180px;
            width: 100%;
        }
    }
</style>

<section aria-live="polite" class="projects-grid" id="projects-list"></section>
<p class="projects-message" id="projects-message">Loading projects...</p>

<template id="project-card-template">
    <article class="project-card">
        <div class="project-card__image project-card__image--empty" data-project-image>Project preview</div>
        <div class="project-card__content">
            <p class="project-card__category" data-project-category></p>
            <h2 class="project-card__title" data-project-title></h2>
            <p class="project-card__description" data-project-description></p>
            <a class="project-card__link" data-project-link rel="noopener noreferrer" target="_blank">View project</a>
        </div>
    </article>
</template>
