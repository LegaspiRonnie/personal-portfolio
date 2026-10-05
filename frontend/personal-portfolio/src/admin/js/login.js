const loginForm = document.getElementById("loginForm");
const loginScript = document.currentScript;

if (loginForm instanceof HTMLFormElement) {
    const emailInput = loginForm.querySelector("#email");
    const passwordInput = loginForm.querySelector("#password");
    const message = loginForm.querySelector("#loginMessage");
    const submitButton = loginForm.querySelector('button[type="submit"]');
    const redirectUrl = loginScript instanceof HTMLScriptElement
        ? new URL("../index.php", loginScript.src).href
        : null;

    loginForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        if (
            !(emailInput instanceof HTMLInputElement)
            || !(passwordInput instanceof HTMLInputElement)
            || !(message instanceof HTMLElement)
            || !(submitButton instanceof HTMLButtonElement)
            || !loginForm.dataset.apiUrl
            || !redirectUrl
        ) {
            return;
        }

        message.hidden = true;
        submitButton.disabled = true;

        try {
            const response = await fetch(loginForm.dataset.apiUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                },
                credentials: "same-origin",
                body: JSON.stringify({
                    email: emailInput.value.trim(),
                    password: passwordInput.value,
                }),
            });
            const result = await response.json();

            if (response.ok && result.status === "success") {
                window.location.assign(redirectUrl);
                return;
            }

            message.textContent = result.message || "Unable to sign in.";
            message.hidden = false;
        } catch {
            message.textContent = "Unable to reach the login service. Please try again.";
            message.hidden = false;
        } finally {
            submitButton.disabled = false;
        }
    });
}