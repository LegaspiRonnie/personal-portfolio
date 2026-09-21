<?php
?>

<div class="loader" role="status" aria-live="polite" aria-label="Loading">
    <div class="loader__spinner" aria-hidden="true"></div>
    <span class="loader__text">Loading...</span>
</div>

<style>
    .loader {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 0.9rem;
        min-height: 220px;
        width: 100%;
        padding: 2rem 1rem;
        border-radius: 16px;
        background: #ffffff;
        color: #111827;
        font-family: Arial, Helvetica, sans-serif;
    }

    .loader__spinner {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        border: 4px solid #e5e7eb;
        border-top-color: #2563eb;
        animation: loader-spin 0.9s linear infinite;
    }

    .loader__text {
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: #475569;
    }

    @keyframes loader-spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
