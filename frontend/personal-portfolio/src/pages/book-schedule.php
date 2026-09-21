<?php
// 1. Set the browser title for the portfolio homepage.
$pageTitle = 'Book a Schedule | Ronnie Legaspi';
$pageDescription = 'View Ronnie Legaspi\'s availability and schedule a conversation about web development, backend systems, API integrations, or consulting.';
include_once __DIR__ . '/../components/icon.php';

// 2. Start buffering the HTML output
ob_start(); 
?>

<!-- Everything inside here is captured into the buffer -->
<style>
    .booking-shell {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 2rem 1.25rem 3rem;
        
        color: #111827;
        font-family: Arial, sans-serif;
    }

    .booking-shell__header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .booking-shell__eyebrow {
        margin: 0 0 0.7rem;
        color: #2563eb;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        font-size: 0.72rem;
    }

    .booking-shell__header h2 {
        margin: 0;
        font-size: clamp(2rem, 4vw, 3rem);
        color: #111827;
    }

    .booking-shell__header p {
        max-width: 700px;
        margin: 0.9rem auto 0;
        color: #4b5563;
        font-size: 1rem;
    }

    .booking-shell__cards {
        display: grid;
        grid-template-columns: repeat(3, minmax(200px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .booking-card {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 1.25rem;
        box-shadow: 0 8px 20px rgba(17, 24, 39, 0.04);
    }

    .booking-card__tag {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 999px;
        padding: 0.4rem 0.7rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .booking-card h3 {
        margin: 1rem 0 0.7rem;
        font-size: 1.3rem;
        color: #111827;
    }

    .booking-card p {
        margin: 0;
        color: #4b5563;
        line-height: 1.6;
    }

    .booking-shell__panel {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 1.5rem;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 22px;
        padding: 1.25rem;
        box-shadow: 0 10px 30px rgba(17, 24, 39, 0.05);
    }

    .booking-shell__copy {
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 1.25rem;
    }

    .booking-shell__copy h3 {
        margin: 0 0 0.7rem;
        font-size: 1.7rem;
        color: #111827;
    }

    .booking-shell__copy p {
        margin: 0 0 1rem;
        color: #4b5563;
        line-height: 1.6;
    }

    .booking-shell__button {
        border: none;
        background: #2563eb;
        color: #ffffff;
        border-radius: 999px;
        padding: 0.9rem 1.5rem;
        font-size: 0.98rem;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s ease, background 0.2s ease;
    }

    .booking-shell__button:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    .booking-shell__calendar-wrap {
        position: relative;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        overflow: hidden;
        min-height: 520px;
    }

    .booking-shell__calendar-loader {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.96);
        z-index: 2;
    }

    .booking-shell__calendar {
        display: block;
        width: 100%;
        min-height: 520px;
        border: 0;
        background: #ffffff;
        visibility: hidden;
    }

    .booking-modal {
        position: fixed;
        inset: 0;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 1.25rem;
    }

    .booking-modal.is-open {
        display: flex;
    }

    .booking-modal__backdrop {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(3px);
    }

    .booking-modal__dialog {
        position: relative;
        z-index: 1;
        width: min(560px, 100%);
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 22px;
        box-shadow: 0 22px 50px rgba(17, 24, 39, 0.08);
        padding: 2rem 1.25rem 1.25rem;
    }

    .booking-modal__close {
        position: absolute;
        top: 0.8rem;
        right: 0.8rem;
        width: 40px;
        height: 40px;
        border: 1px solid #e5e7eb;
        border-radius: 50%;
        background: #ffffff;
        color: #111827;
        font-size: 2rem;
        line-height: 1;
        cursor: pointer;
    }

    .booking-modal__content {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 300px;
    }

    .booking-modal__gif {
        display: block;
        width: min(380px, 85%);
        border-radius: 18px;
    }

    @media (max-width: 860px) {
        .booking-shell__cards {
            grid-template-columns: 1fr;
        }

        .booking-shell__panel {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="booking-shell" aria-label="Booking schedule section">
    <div class="booking-shell__header">
        <p class="booking-shell__eyebrow">Availability</p>
        <h2><?php echo portfolioIcon('calendar', 'Schedule a conversation'); ?>Let’s plan your next project</h2>
        <p>Here is my current schedule. If you want to book a session, click the button below.</p>
    </div>

    <!-- <div class="booking-shell__cards">
        <article class="booking-card">
            <span class="booking-card__tag">Consulting</span>
            <h3><?php echo portfolioIcon('phone', 'Discovery call'); ?>Discovery Call</h3>
            <p>30 minutes to talk through your goals, needs, and timeline.</p>
        </article>

        <article class="booking-card">
            <span class="booking-card__tag">Development</span>
            <h3><?php echo portfolioIcon('briefcase', 'Project planning'); ?>Project Planning</h3>
            <p>Best for technical discussions, product planning, and roadmap reviews.</p>
        </article>

        <article class="booking-card">
            <span class="booking-card__tag">Collaboration</span>
            <h3><?php echo portfolioIcon('code', 'Technical session'); ?>Longer Session</h3>
            <p>For deeper conversations, design feedback, or technical consulting.</p>
        </article>
    </div> -->

    <div class="booking-shell__panel">
        <div class="booking-shell__copy">
            <h3><?php echo portfolioIcon('calendar', 'Availability'); ?>My schedule</h3>
            <p>Available for freelance work, consulting, and collaboration opportunities.</p>
            <button type="button" class="booking-shell__button" data-booking-trigger>Book a Schedule</button>
        </div>

        <div class="booking-shell__calendar-wrap">
            <div class="booking-shell__calendar-loader" id="calendarLoader">
                <?php include __DIR__ . '/../components/loader.php'; ?>
            </div>

            <iframe
                src="https://calendar.google.com/calendar/embed?src=ronnielegaspi98%40gmail.com&ctz=Asia%2FManila&mode=WEEK"
                title="Ronnie Legaspi Calendar"
                class="booking-shell__calendar"
                loading="lazy"
                scrolling="no"
                frameborder="0"
                onload="this.previousElementSibling.style.display='none'; this.style.visibility='visible';">
            </iframe>
        </div>
    </div>
</section>

<div id="booking-modal" class="booking-modal" aria-hidden="true">
    <div class="booking-modal__backdrop" data-close-booking="true"></div>

    <div class="booking-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="booking-modal-title">
        <button type="button" class="booking-modal__close" data-close-booking="true" aria-label="Close booking modal">&times;</button>

        <div class="booking-modal__content">
            <img src="../../assets/images/under-development.gif" alt="Under development animation" class="booking-modal__gif" id="booking-modal-title">
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('booking-modal');
        const loader = document.getElementById('calendarLoader');
        const calendar = document.querySelector('.booking-shell__calendar');

        if (loader && calendar) {
            calendar.addEventListener('load', function () {
                loader.style.display = 'none';
                calendar.style.visibility = 'visible';
            });
        }

        if (!modal) return;

        const openButtons = document.querySelectorAll('[data-booking-trigger], [href="#booking-modal"]');
        const closeButtons = modal.querySelectorAll('[data-close-booking="true"]');

        function openModal() {
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
        }

        function closeModal() {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
        }

        openButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                openModal();
            });
        });

        closeButtons.forEach(function (button) {
            button.addEventListener('click', closeModal);
        });

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                closeModal();
            }
        });
    });
</script>

<?php 
// 3. Save the captured HTML into $content and clear the buffer
$content = ob_get_clean(); 

// 4. Load the master layout, which will now echo our $content
include '../layout/layout.php'; 
?>


