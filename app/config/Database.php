<?php
declare(strict_types=1);

require_once __DIR__ . '/Environment.php';

final class Database
{
    public static function connect(string $prefix): PDO
    {
        $host = Environment::get($prefix . '_DB_HOST');
        $port = Environment::get($prefix . '_DB_PORT', '3306');
        $name = Environment::get($prefix . '_DB_NAME');
        $user = Environment::get($prefix . '_DB_USER');
        $password = Environment::get($prefix . '_DB_PASSWORD');

        if ($host === '' || $name === '' || $user === '') {
            throw new RuntimeException($prefix . ' database settings are incomplete.');
        }

        return new PDO(
            'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $name . ';charset=utf8mb4',
            $user,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }
}
