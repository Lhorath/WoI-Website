<?php
define('ROOT_PATH', dirname(__DIR__));
$_SERVER['PHP_SELF'] = '/index.php';

putenv('DB_HOST=127.0.0.9');
putenv('DB_USERNAME=woi_test_user');
putenv('DB_PASSWORD=woi_test_password');
putenv('DB_AUTH=woi_auth_test');

require ROOT_PATH . '/utility/settings.php';

$checks = array(
    isset($config['host']) && $config['host'] === '127.0.0.9',
    isset($config['user']) && $config['user'] === 'woi_test_user',
    isset($config['pass']) && $config['pass'] === 'woi_test_password',
    isset($config['realm_db']) && $config['realm_db'] === 'woi_auth_test',
    array_key_exists('site_db', $config),
    array_key_exists('blizz_char_db', $config),
    array_key_exists('paypal_email', $config)
);

foreach ($checks as $passed) {
    if (!$passed) {
        fwrite(STDERR, "Legacy configuration bridge test failed.\n");
        exit(1);
    }
}

echo "Legacy configuration bridge test passed.\n";
