<?php
$pageTitle = 'Contact | Ronnie Legaspi';
$pageDescription = 'Contact Ronnie Legaspi about backend development, Laravel and React applications, API integrations, software engineering, and technical consulting.';
ob_start();
?>

<div class="contact-page">
    <section class="contact-intro">
        <p class="contact-eyebrow">[ contact ]</p>
        <h1>Let’s build something useful.</h1>
        <p>Have an opportunity, a project, or a technical problem to solve? Send a message and I’ll get back to you.</p>
    </section>

    <div class="contact-layout">
        <form class="contact-form" id="contactForm">
            <div class="contact-form__field-grid">
                <label>
                    Name
                    <input type="text" name="name" autocomplete="name" required>
                </label>
                <label>
                    Email
                    <input type="email" name="email" autocomplete="email" required>
                </label>
            </div>
            <label>
                Subject
                <input type="text" name="subject" required>
            </label>
            <label>
                Message
                <textarea name="message" rows="7" required></textarea>
            </label>
            <button type="submit">
                <span class="content-icon" title="Send message" aria-hidden="true">
                    <svg viewBox="0 0 24 24" focusable="false"><path d="M4 4h16v16H4zM4 4l8 8 8-8M4 20l6-6m4 0 6 6" /></svg>
                </span>
                Send message
            </button>
            <p class="contact-form__note">This form opens your email app to send the message.</p>
        </form>

        <aside class="contact-details">
            <p class="contact-eyebrow">Direct contact</p>
            <a href="mailto:ronnielegaspi98@gmail.com">
                <span class="content-icon" title="Email" aria-hidden="true">
                    <svg viewBox="0 0 24 24" focusable="false"><path d="M3 5h18v14H3zM3 6l9 7 9-7" /></svg>
                </span>
                ronnielegaspi98@gmail.com
            </a>
            <a href="tel:+639930954435">
                <span class="content-icon" title="Phone" aria-hidden="true">
                    <svg viewBox="0 0 24 24" focusable="false"><path d="M6 3h4l2 5-2.5 1.5a15 15 0 0 0 5 5L16 12l5 2v4c0 1.1-.9 2-2 2C10.7 20 4 13.3 4 5c0-1.1.9-2 2-2z" /></svg>
                </span>
                +63 993 095 4435
            </a>
            <span>
                <span class="content-icon" title="Location" aria-hidden="true">
                    <svg viewBox="0 0 24 24" focusable="false"><path d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12zM12 11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" /></svg>
                </span>
                Villegas Poruk 1-a, Pozorrubio, Pangasinan
            </span>
            <p>Best for web development, backend systems, API integrations, and technical consulting.</p>
        </aside>
    </div>
</div>

<style>
    .contact-page { width: min(980px, calc(100% - 2rem)); margin: 0 auto; padding: 4rem 0 6rem; color: #111827; }
    .contact-intro { max-width: 720px; padding-bottom: 2.5rem; }
    .contact-eyebrow { margin: 0 0 1rem; color: #2563eb; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.14em; text-transform: lowercase; }
    .contact-intro h1 { margin: 0; font-size: clamp(2.5rem, 6vw, 4.8rem); line-height: 0.95; letter-spacing: -0.07em; }
    .contact-intro > p:last-child { max-width: 620px; margin: 1.25rem 0 0; color: #5b6472; font-size: 1.05rem; line-height: 1.7; }
    .contact-layout { display: grid; grid-template-columns: 1.35fr 0.65fr; gap: 3rem; padding-top: 2.5rem; border-top: 1px solid #e5e7eb; }
    .contact-form { display: grid; gap: 1.2rem; }
    .contact-form__field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .contact-form label { display: grid; gap: 0.45rem; color: #111827; font-size: 0.85rem; font-weight: 700; }
    .contact-form input, .contact-form textarea { width: 100%; border: 1px solid #dbe3ee; border-radius: 8px; padding: 0.85rem 0.9rem; color: #111827; background: #fff; font: inherit; resize: vertical; }
    .contact-form input:focus, .contact-form textarea:focus { outline: 2px solid #93c5fd; outline-offset: 1px; border-color: #2563eb; }
    .contact-form button { justify-self: start; border: 0; border-radius: 999px; padding: 0.85rem 1.3rem; background: #2563eb; color: #fff; font: inherit; font-weight: 700; cursor: pointer; }
    .contact-form button:hover { background: #1d4ed8; }
    .content-icon { display: inline-flex; width: 1.1rem; height: 1.1rem; margin-right: 0.45rem; vertical-align: -0.2rem; color: #2563eb; }
    .content-icon svg { width: 100%; height: 100%; fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.7; }
    .contact-form button .content-icon { color: currentColor; }
    .contact-form__note { margin: -0.5rem 0 0; color: #64748b; font-size: 0.8rem; }
    .contact-details { display: grid; align-content: start; gap: 0.9rem; padding-left: 1.5rem; border-left: 2px solid #2563eb; }
    .contact-details .contact-eyebrow { margin-bottom: 0.2rem; }
    .contact-details > a, .contact-details > span { color: #5b6472; line-height: 1.45; overflow-wrap: anywhere; }
    .contact-details a:hover { color: #2563eb; }
    .contact-details p:last-child { margin: 1rem 0 0; color: #64748b; line-height: 1.65; }
    @media (max-width: 760px) { .contact-page { padding-top: 3rem; } .contact-layout, .contact-form__field-grid { grid-template-columns: 1fr; gap: 1.5rem; } .contact-details { padding: 1.25rem 0 0; border-top: 2px solid #2563eb; border-left: 0; } }
</style>

<script>
    document.getElementById('contactForm')?.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const subject = encodeURIComponent(formData.get('subject'));
        const body = encodeURIComponent(`Name: ${formData.get('name')}\nEmail: ${formData.get('email')}\n\n${formData.get('message')}`);
        window.location.href = `mailto:ronnielegaspi98@gmail.com?subject=${subject}&body=${body}`;
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/layout.php';
?>
