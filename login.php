<?php
session_start();

// Simple demo login (in production, use database, hashing, etc.)
$demo_username = 'student';
$demo_password = 'pass'; // Plain for demo; hash in real app

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === $demo_username && $password === $demo_password) {
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $username;
        header('Location: index.html'); // Redirect to the provided homepage
        exit;
    } else {
        $error = 'Ongeldige gebruikersnaam of wachtwoord.';
    }
}

// If already logged in, redirect
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen - Student Planning</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 200;
            font-style: normal;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(to bottom right, #f1efe7, #f3f4f6);
            padding: 20px;
            color: #1f2937;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
        }

        /* Header Styles */
        .top-bar {
            background: linear-gradient(to right, #f1efe7, #d5d3cc);
            padding: 16px;
            border-radius: 12px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
            max-height: 120px;
        }

        .logo-box {
            width: 220px;
            height: 100px;
            background: linear-gradient(to bottom right, #221cda, #2563eb);
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text {
            color: white;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .page-title {
            font-size: 24px;
            color: #1f2937;
            font-weight: 500;
            letter-spacing: 0.05em;
        }

        /* Login Form Styles */
        .login-box {
            background: white;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }

        .login-heading {
            font-size: 28px;
            font-weight: 500;
            color: #1f2937;
            text-align: center;
            margin-bottom: 24px;
        }

        .error-message {
            background: #fef2f2;
            color: #dc2626;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #fecaca;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 400;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-family: inherit;
            font-size: 16px;
            transition: all 0.2s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #221cda;
            ring: 2px solid #221cda;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #221cda, #2563eb);
            color: white;
            border-radius: 8px;
            border: none;
            font-weight: 400;
            font-size: 16px;
            cursor: pointer;
            transition: box-shadow 0.3s ease;
        }

        .submit-button:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .demo-info {
            text-align: center;
            margin-top: 16px;
            font-size: 12px;
            color: #6b7280;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .top-bar {
                padding: 12px;
            }

            .logo-box {
                width: 180px;
                height: 80px;
            }

            .logo-text {
                font-size: 20px;
            }

            .page-title {
                font-size: 20px;
            }

            .login-box {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Header -->
        <header class="top-bar">
            <div class="logo-box">
                <div class="logo-text">Student Planning</div>
            </div>
            <h1 class="page-title">Welkom</h1>
        </header>

        <!-- Login Form -->
        <div class="login-box">
            <h2 class="login-heading">Inloggen</h2>

            <?php if ($error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="username" class="form-label">Gebruikersnaam</label>
                    <input type="text" id="username" name="username" class="form-input" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Wachtwoord</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>

                <button type="submit" class="submit-button">Inloggen</button>
            </form>

            <div class="demo-info">
                Demo: Gebruikersnaam: <strong>student</strong> | Wachtwoord: <strong>pass</strong>
            </div>
        </div>
    </div>
</body>
</html>