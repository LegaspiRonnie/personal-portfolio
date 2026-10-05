<?php

session_start();

$scriptPath = $_SERVER['SCRIPT_NAME'] ?? '/';

if (!empty($_SESSION['log_in'])) {
    header('Location: ' . rtrim(dirname($scriptPath, 3), '/') . '/index.php');
    exit;
}

$pageTitle = 'Admin Login';
$apiUrl = rtrim(dirname($scriptPath, 7), '/') . '/backend/personal-portfolio/api/v1/login.php';
$loginScriptUrl = rtrim(dirname($scriptPath, 4), '/') . '/admin/js/login.js';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            display: grid;
            min-height: 100vh;
            margin: 0;
            place-items: center;
            padding: 1.5rem;
            background: #f1f4f9;
            color: #172033;
            font-family: Arial, sans-serif;
        }

        .login-card {
            width: min(100%, 26rem);
            padding: 2rem;
            border: 1px solid #e1e6ef;
            border-radius: 0.75rem;
            background: #fff;
            box-shadow: 0 1rem 2.5rem rgb(23 32 51 / 8%);
        }

        .login-card h1 {
            margin: 0 0 0.5rem;
            font-size: 1.75rem;
        }

        .login-card__description {
            margin: 0 0 1.75rem;
            color: #596579;
        }

        .login-form {
            display: grid;
            gap: 1rem;
        }

        .login-form label {
            display: grid;
            gap: 0.4rem;
            font-weight: 600;
        }

        .login-form input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cbd3df;
            border-radius: 0.4rem;
            font: inherit;
        }

        .login-form input:focus {
            border-color: #315fbd;
            outline: 3px solid rgb(49 95 189 / 18%);
        }

        .login-form button {
            margin-top: 0.5rem;
            padding: 0.8rem 1rem;
            border: 0;
            border-radius: 0.4rem;
            background: #172033;
            color: #fff;
            cursor: pointer;
            font: inherit;
            font-weight: 700;
        }

        .login-form button:hover {
            background: #2b3952;
        }
    </style>
</head>
<body>
    <main class="login-card">
        <h1>Admin Login</h1>
        <p class="login-card__description">Sign in to manage your portfolio.</p>

        <form
            class="login-form"
            id="loginForm"
            data-api-url="<?php echo htmlspecialchars($apiUrl, ENT_QUOTES, 'UTF-8'); ?>"
        >
            <p id="loginMessage" role="status" aria-live="polite" hidden></p>

            <label for="email">
                Email
                <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="username"
                    required
                >
            </label>

            <label for="password">
                Password
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                >
            </label>

            <button type="submit">Log in</button>
        </form>
    </main>

    <script src="<?php echo htmlspecialchars($loginScriptUrl, ENT_QUOTES, 'UTF-8'); ?>" defer></script>
</body>
</html>