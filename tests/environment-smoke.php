<?php
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');

require_once APP_PATH . '/Core/Environment.php';

$key = 'WOI_ENV_SMOKE_VALUE';
putenv($key);
$tempFile = tempnam(sys_get_temp_dir(), 'woi-env-');

if ($tempFile === false) {
    fwrite(STDERR, "Unable to create temporary environment file.\n");
    exit(1);
}

file_put_contents($tempFile, $key . "=\"value with spaces\"\n");
\WoI\Core\Environment::load($tempFile);
$value = getenv($key);

unlink($tempFile);
putenv($key);

if ($value !== 'value with spaces') {
    fwrite(STDERR, "Environment smoke test failed.\n");
    exit(1);
}

echo "Environment smoke test passed.\n";
