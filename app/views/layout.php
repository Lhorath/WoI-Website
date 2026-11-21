<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/config/Environment.php';
Environment::load(dirname(__DIR__, 2) . '/.env');
$discordUrl = Environment::get('DISCORD_INVITE_URL', Environment::get('DISCORD_URL', 'https://discord.gg/G3rKQfQ'));
if (!preg_match('#^https?://#i', $discordUrl)) {
    $discordUrl = 'https://' . ltrim($discordUrl, '/');
}

if (!isset($basePath)) {
    $scriptDir = trim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
    $depth = $scriptDir === '' ? 0 : count(explode('/', $scriptDir));
    $basePath = $depth > 0 ? str_repeat('../', $depth) : '';
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
