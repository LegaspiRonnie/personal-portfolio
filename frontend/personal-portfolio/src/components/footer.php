<?php
$data = require __DIR__ . '/../config/data.php';
$sitePages = $data['sitePages'];
$footerLinks = $data['footerLinks'];
$siteContact = $data['siteContact'];
$footerLocation = $data['footerLocation'];
$siteMetadata = $data['siteMetadata'];
?>

<footer class="site-footer" id="contact">
    <div class="site-footer__container">
        <div class="site-footer__top-row">
            <div class="site-footer__brand-block">
                <a href="<?php echo htmlspecialchars($sitePages['home'], ENT_QUOTES, 'UTF-8'); ?>" class="site-footer__brand">Ronnie-Legaspi</a>
                <p>
                    Building practical, modern digital experiences with clean design, solid systems,
                    and a focus on user value.
                </p>
            </div>

            <div class="site-footer__links">
                <div class="site-footer__group">
                    <h3>Explore</h3>
                    <ul>
                        <li><a href="<?php echo htmlspecialchars($sitePages['home'], ENT_QUOTES, 'UTF-8'); ?>">Home</a></li>
                        <li><a href="<?php echo htmlspecialchars($sitePages['profile'], ENT_QUOTES, 'UTF-8'); ?>">Profile</a></li>
                        <li><a href="<?php echo htmlspecialchars($sitePages['projects'], ENT_QUOTES, 'UTF-8'); ?>">Projects</a></li>
                        <li><a href="<?php echo htmlspecialchars($sitePages['contact'], ENT_QUOTES, 'UTF-8'); ?>">Contact</a></li>
                        <li><a href="<?php echo htmlspecialchars($sitePages['book_schedule'], ENT_QUOTES, 'UTF-8'); ?>">Book a Call</a></li>
                    </ul>
                </div>

                <div class="site-footer__group">
                    <h3>Connect</h3>
                    <ul>
                        <li><a href="<?php echo htmlspecialchars($footerLinks['github'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">GitHub</a></li>
                        <li><a href="<?php echo htmlspecialchars($footerLinks['linkedin'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">LinkedIn</a></li>
                        <li><a href="<?php echo htmlspecialchars($footerLinks['instagram'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Instagram</a></li>
                        <li><a href="<?php echo htmlspecialchars($footerLinks['facebook'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Facebook</a></li>
                        <li><a href="<?php echo htmlspecialchars($footerLinks['youtube'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Youtube</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="site-footer__contact-row">
            <div class="site-footer__contact-copy">
                <span class="site-footer__eyebrow">[ contact ]</span>
                <h2>Let's talk</h2>
                <p>Have an opportunity, a project, or just want to connect? Send a message and I'll get back to you.</p>

                <div class="site-footer__contact-list">
                    <a href="mailto:<?php echo htmlspecialchars($siteContact['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($siteContact['email'], ENT_QUOTES, 'UTF-8'); ?></a>
                    <a href="tel:<?php echo htmlspecialchars($siteContact['phone'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($siteContact['phone'], ENT_QUOTES, 'UTF-8'); ?></a>
                    <span><?php echo htmlspecialchars($footerLocation['label'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <a href="<?php echo htmlspecialchars($sitePages['home'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars(parse_url($siteMetadata['site_url'], PHP_URL_HOST) ?: $siteMetadata['site_url'], ENT_QUOTES, 'UTF-8'); ?></a>
                </div>
            </div>

            <div class="site-footer__map-card">
                <div
                    id="footer-map"
                    class="leaflet-map"
                    data-lat="<?php echo htmlspecialchars((string) $footerLocation['lat'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-long="<?php echo htmlspecialchars((string) $footerLocation['long'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-zoom="<?php echo htmlspecialchars((string) $footerLocation['zoom'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-icon="<?php echo htmlspecialchars($footerLocation['icon'], ENT_QUOTES, 'UTF-8'); ?>"
                    aria-label="Map showing Ronnie Legaspi's location">
                    <div class="site-footer__map-loader" id="footer-map-loader">
                        <?php include __DIR__ . '/loader.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-footer__bottom">
        <p>© 2026 Ronnie-Legaspi. All rights reserved.</p>
    </div>
</footer>

<style>
    .site-footer {
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
        color: #111827;
        font-family: Arial, Helvetica, sans-serif;
    }

    .site-footer__container {
        width: min(1180px, calc(100% - 2rem));
        margin: 0 auto;
        padding: 2.75rem 0 2.25rem;
    }

    .site-footer__top-row,
    .site-footer__contact-row {
        display: grid;
        grid-template-columns: 1.05fr 1fr;
        gap: 2.5rem;
        align-items: start;
    }

    .site-footer__contact-row {
        margin-top: 2.75rem;
        padding-top: 2.5rem;
        border-top: 1px solid #e5e7eb;
    }

    .site-footer__brand-block {
        max-width: 520px;
    }

    .site-footer__brand {
        display: inline-block;
        font-size: 1.7rem;
        font-weight: 700;
        letter-spacing: -0.05em;
        color: #111827;
        margin-bottom: 0.75rem;
    }

    .site-footer__brand-block p {
        margin: 0;
        color: #5b6472;
        line-height: 1.7;
    }

    .site-footer__links {
        display: grid;
        grid-template-columns: repeat(2, minmax(140px, 1fr));
        gap: 2rem;
    }

    .site-footer__map-card {
        min-width: 0;
        max-width: 100%;
        height: 270px;
        border: 1px solid #2f4c75;
        border-radius: 14px;
    }

    .site-footer__eyebrow {
        display: block;
        margin-bottom: 0.5rem;
        color: #2563eb;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: lowercase;
    }

    .site-footer__contact-copy h2 {
        margin: 0;
        color: #111827;
        font-size: clamp(2rem, 4vw, 3.25rem);
        line-height: 1;
        letter-spacing: -0.05em;
    }

    .site-footer__contact-copy > p {
        max-width: 520px;
        margin: 0.9rem 0 0;
        color: #64748b;
        font-size: 0.98rem;
        line-height: 1.55;
    }

    .site-footer__contact-list {
        display: grid;
        gap: 0.55rem;
        margin-top: 1.2rem;
    }

    .site-footer__contact-list a,
    .site-footer__contact-list span {
        color: #5b6472;
        line-height: 1.4;
        text-decoration: none;
    }

    .site-footer__contact-list a:hover,
    .site-footer__contact-list a:focus {
        color: #2563eb;
    }

    #footer-map {
        position: relative;
        height: 100%;
        overflow: hidden;
        border: 1px solid #dbe3ee;
        border-radius: 14px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        isolation: isolate;
    }

    .site-footer__map-loader {
        position: absolute;
        inset: 0;
        z-index: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        transition: opacity 0.25s ease, visibility 0.25s ease;
    }

    .site-footer__map-loader.is-hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .site-footer__map-loader .loader {
        min-height: 120px;
        padding: 1rem;
        background: transparent;
    }

    .site-footer__map-loader .loader__spinner {
        width: 38px;
        height: 38px;
        border-width: 3px;
    }

    .site-footer__map-loader .loader__text {
        font-size: 0.72rem;
    }

    #footer-map .leaflet-control-zoom {
        border: 0;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.14);
    }

    #footer-map .leaflet-control-zoom a {
        color: #1e3a8a;
    }

    #footer-map .leaflet-control-attribution {
        background: rgba(255, 255, 255, 0.88);
        color: #64748b;
        font-size: 0.62rem;
    }

    .site-footer__group h3 {
        margin: 0 0 0.65rem;
        font-size: 1rem;
        color: #111827;
    }

    .site-footer__group ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: 0.5rem;
    }

    .site-footer__group a {
        color: #5b6472;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .site-footer__group a:hover,
    .site-footer__group a:focus {
        color: #2563eb;
    }

    .site-footer__bottom {
        border-top: 1px solid #e5e7eb;
        padding: 0.8rem 0 1.25rem;
        text-align: center;
        color: #6b7280;
        font-size: 0.9rem;
    }

    .site-footer__bottom p {
        margin: 0;
    }

    @media (max-width: 860px) {
        .site-footer__top-row,
        .site-footer__contact-row {
            grid-template-columns: 1fr;
            gap: 1.75rem;
        }

        .site-footer__container {
            padding-top: 2.25rem;
        }

        .site-footer__links {
            grid-template-columns: 1fr 1fr;
        }

        .site-footer__contact-row {
            margin-top: 2.25rem;
            padding-top: 2rem;
        }
    }

    @media (max-width: 540px) {
        .site-footer__links {
            grid-template-columns: 1fr;
        }
    }
</style>

