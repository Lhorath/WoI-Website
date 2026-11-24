<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/config/Environment.php';
Environment::load(dirname(__DIR__, 2) . '/.env');
$discordUrl = Environment::get('DISCORD_INVITE_URL', Environment::get('DISCORD_URL', 'https://discord.gg/G3rKQfQ'));
if (!preg_match('#^https?://#i', $discordUrl)) {
    $discordUrl = 'https://' . ltrim($discordUrl, '/');
}

if (!isset($basePath)) {
    // Compare the website's actual folder on disk against the server's document root
    $appRoot = str_replace('\\', '/', dirname(__DIR__, 2));
    $docRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? ''), '/');

    if ($docRoot !== '' && strpos($appRoot, $docRoot) === 0) {
        $subDir = trim(substr($appRoot, strlen($docRoot)), '/');
        $basePath = $subDir === '' ? '/' : '/' . $subDir . '/';
    } else {
        $basePath = '/';
    }
}


$escape = static fn(string $value): string => htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<!doctype html>
<html lang="en">
<?php require __DIR__ . '/partials/header.php'; ?>
<body>
<?php require __DIR__ . '/partials/body.php'; ?>
<?php if (!empty($includeSliderScript)): ?>
    <script src="<?= $basePath ?>assets/js/slider.js" defer></script>
<?php endif; ?>
</body>
</html>
