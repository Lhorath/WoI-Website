<?php
declare(strict_types=1);

session_set_cookie_params([
    'httponly' => true,
    'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    'samesite' => 'Lax',
]);
session_start();

require_once __DIR__ . '/srp6.php';
require_once __DIR__ . '/app/config/Environment.php';

$configurationError = false;
$envPath = __DIR__ . '/.env';
$configurationError = !Environment::load($envPath);

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

if (!isset($_SESSION['registration_csrf'])) {
    $_SESSION['registration_csrf'] = bin2hex(random_bytes(32));
}

$message = '';
$messageType = '';
$usernameValue = '';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $usernameValue = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $passwordConfirmation = (string) ($_POST['password_confirmation'] ?? '');
    $csrfToken = (string) ($_POST['csrf_token'] ?? '');

    if (!hash_equals($_SESSION['registration_csrf'], $csrfToken)) {
        $message = 'Your form session expired. Refresh the page and try again.';
        $messageType = 'error';
    } elseif ($configurationError) {
        $message = 'The site configuration could not be read. Please contact the server administrator.';
        $messageType = 'error';
    } elseif (!extension_loaded('gmp') || !extension_loaded('pdo_mysql')) {
        error_log('Registration requires the PHP GMP and PDO MySQL extensions.');
        $message = 'Registration is not available because a required PHP extension is missing.';
        $messageType = 'error';
    } elseif (!preg_match('/^[A-Za-z0-9_]{3,32}$/', $usernameValue)) {
        $message = 'Choose a username of 3 to 32 letters, numbers, or underscores.';
        $messageType = 'error';
    } elseif (strlen($password) < 8 || strlen($password) > 64 || !preg_match('/^[\x21-\x7E]+$/', $password)) {
        $message = 'Choose a password of 8 to 64 printable ASCII characters (no spaces).';
        $messageType = 'error';
    } elseif (!hash_equals($password, $passwordConfirmation)) {
        $message = 'The passwords do not match.';
        $messageType = 'error';
    } else {
        $username = strtoupper($usernameValue);
        $authHost = Environment::get('AUTH_DB_HOST');
        $authPort = Environment::get('AUTH_DB_PORT', '3306');
        $authName = Environment::get('AUTH_DB_NAME');
        $authUser = Environment::get('AUTH_DB_USER');
        $authPassword = Environment::get('AUTH_DB_PASSWORD');

        if ($authHost === '' || $authName === '' || $authUser === '') {
            error_log('Registration auth database settings are incomplete.');
            $message = 'The site is not configured for registration yet. Please contact the server administrator.';
            $messageType = 'error';
        } else {
            try {
                $pdo = new PDO(
                    'mysql:host=' . $authHost . ';port=' . $authPort . ';dbname=' . $authName . ';charset=utf8mb4',
                    $authUser,
                    $authPassword,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
                $check = $pdo->prepare('SELECT id FROM account WHERE username = :username LIMIT 1');
                $check->execute(['username' => $username]);

                if ($check->fetchColumn() !== false) {
                    $message = 'That username is already registered.';
                    $messageType = 'error';
                } else {
                    $credentials = createTrinityCoreSrp6Credentials($username, $password);
                    $insert = $pdo->prepare(
                        'INSERT INTO account (username, salt, verifier) VALUES (:username, :salt, :verifier)'
                    );
                    $insert->bindValue(':username', $username);
                    $insert->bindValue(':salt', $credentials['salt'], PDO::PARAM_LOB);
                    $insert->bindValue(':verifier', $credentials['verifier'], PDO::PARAM_LOB);
                    $insert->execute();

                    $_SESSION['registration_csrf'] = bin2hex(random_bytes(32));
                    $usernameValue = '';
                    $message = 'Your account has been created. You can now log in to the game.';
                    $messageType = 'success';
                }
            } catch (PDOException $exception) {
                error_log('Registration database error: ' . $exception->getMessage());
                if (($exception->errorInfo[1] ?? null) === 1062) {
                    $message = 'That username is already registered.';
                } else {
                    $message = 'We could not create your account right now. Please try again later.';
                }
                $messageType = 'error';
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark">
    <title>Create an Account | TrinityCore</title>
    <style>
        :root {
            color-scheme: dark;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            background: #10131a;
            color: #f2f4f8;
        }
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 24px;
            background:
                radial-gradient(ellipse at 50% 0, rgba(151, 110, 39, .2), transparent 55%),
                #10131a;
        }
        .card {
            width: min(100%, 440px);
            padding: 36px;
            border: 1px solid #343944;
            border-radius: 16px;
            background: rgba(25, 29, 38, .96);
            box-shadow: 0 24px 70px rgba(0, 0, 0, .4);
        }
        .eyebrow {
            margin: 0 0 8px;
            color: #d3aa5b;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .16em;
            text-transform: uppercase;
        }
        h1 { margin: 0; font-size: 1.8rem; }
        .intro { margin: 10px 0 26px; color: #aab1bf; line-height: 1.55; }
        label { display: block; margin: 18px 0 7px; font-size: .9rem; font-weight: 600; }
        input {
            width: 100%;
            min-height: 46px;
            padding: 10px 12px;
            border: 1px solid #424957;
            border-radius: 8px;
            outline: none;
            background: #11151c;
            color: #f2f4f8;
            font: inherit;
        }
        input:focus { border-color: #d3aa5b; box-shadow: 0 0 0 3px rgba(211, 170, 91, .16); }
        .hint { margin: 6px 0 0; color: #929aaa; font-size: .78rem; }
        button {
            width: 100%;
            min-height: 48px;
            margin-top: 24px;
            border: 0;
            border-radius: 8px;
            background: #c99b45;
            color: #17130b;
            font: inherit;
            font-weight: 750;
            cursor: pointer;
        }
        button:hover { background: #ddb45e; }
        .notice { margin: 18px 0 0; padding: 12px; border-radius: 8px; line-height: 1.45; }
        .notice.error { border: 1px solid #824448; background: #351e24; color: #ffd9dc; }
        .notice.success { border: 1px solid #3e7357; background: #1b3026; color: #d4f5df; }
        .footnote { margin: 20px 0 0; color: #929aaa; font-size: .8rem; line-height: 1.5; text-align: center; }
        @media (max-width: 480px) { .card { padding: 26px 22px; } }
    </style>
</head>
<body>
<main class="card">
    <p class="eyebrow">TrinityCore realms</p>
    <h1>Create your account</h1>
    <p class="intro">Join the adventure. Your password is used to create a TrinityCore SRP6 verifier and is not stored as plain text.</p>

    <?php if ($message !== ''): ?>
        <p class="notice <?= escape($messageType) ?>" role="status"><?= escape($message) ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <input type="hidden" name="csrf_token" value="<?= escape($_SESSION['registration_csrf']) ?>">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" minlength="3" maxlength="32"
               pattern="[A-Za-z0-9_]{3,32}" autocomplete="username" required
               value="<?= escape($usernameValue) ?>">
        <p class="hint">3 to 32 letters, numbers, or underscores.</p>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" minlength="8" maxlength="64"
               autocomplete="new-password" required>
        <p class="hint">8 to 64 printable characters; spaces are not allowed.</p>

        <label for="password_confirmation">Confirm password</label>
        <input id="password_confirmation" name="password_confirmation" type="password"
               minlength="8" maxlength="64" autocomplete="new-password" required>

        <button type="submit">Register account</button>
    </form>

    <p class="footnote">Account registration uses SRP6-compatible credentials. Keep your password private.</p>
</main>
</body>
</html>
