<?php
use WoI\Core\Environment;

return array(
    'name' => Environment::get('APP_NAME', 'World of Immortality'),
    'environment' => Environment::get('APP_ENV', 'production'),
    'debug' => Environment::boolean('APP_DEBUG', false),
    'url' => Environment::get('APP_URL', ''),
    'timezone' => Environment::get('APP_TIMEZONE', 'UTC')
);
