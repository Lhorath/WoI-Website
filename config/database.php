<?php
use WoI\Core\Environment;

/* The legacy global $config array remains the active compatibility interface. */
return array(
    'host' => Environment::get('DB_HOST', '127.0.0.1'),
    'port' => Environment::get('DB_PORT', '3306'),
    'username' => Environment::get('DB_USERNAME', ''),
    'password' => Environment::get('DB_PASSWORD', ''),
    'databases' => array(
        'auth' => Environment::get('DB_AUTH', 'auth'),
        'site' => Environment::get('DB_SITE', 'site'),
        'blizz_char' => Environment::get('DB_BLIZZ_CHAR', 'b_char'),
        'blizz_world' => Environment::get('DB_BLIZZ_WORLD', 'blizz_world2'),
        'pvp_char' => Environment::get('DB_PVP_CHAR', 'f_char'),
        'pvp_world' => Environment::get('DB_PVP_WORLD', 'fun_new_test'),
        'dev_char' => Environment::get('DB_DEV_CHAR', 'f_char'),
        'dev_world' => Environment::get('DB_DEV_WORLD', 'fun_new_test')
    )
);
