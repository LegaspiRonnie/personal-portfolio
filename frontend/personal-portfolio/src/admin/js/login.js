const loginForm = document.getElementById("loginForm");

if (loginForm instanceof HTMLFormElement) {
    const message = document.getElementById("loginMessage");
    const submitButton = loginForm.querySelector('button[type="submit"]');

    loginForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        if (!(message instanceof HTMLElement) || !(submitButton instanceof HTMLButtonElement)) {
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
                    email: loginForm.elements.namedItem("email").value,
                    password: loginForm.elements.namedItem("password").value,
                }),
            });
            const result = await response.json();

            message.textContent = result.message || "Unable to sign in.";
            message.hidden = false;

            if (response.ok && result.status) {
                loginForm.reset();
            }
        } catch (error) {
            message.textContent = "Unable to reach the login service. Please try again.";
            message.hidden = false;
        } finally {
            submitButton.disabled = false;
        }
    });
}