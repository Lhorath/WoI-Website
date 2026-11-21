<?php
declare(strict_types=1);

final class Environment
{
    public static function load(string $path): bool
    {
        if (!is_file($path)) {
            return true;
        }

        if (!is_readable($path)) {
            error_log('Environment configuration file is not readable.');
            return false;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES);
        if ($lines === false) {
            error_log('Environment configuration file could not be read.');
            return false;
        }

        $valid = true;
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            if (!str_contains($line, '=')) {
                error_log('Environment configuration contains an invalid line.');
                $valid = false;
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            if (!preg_match('/^[A-Z][A-Z0-9_]*$/', $key)) {
                error_log('Environment configuration contains an invalid key.');
                $valid = false;
                continue;
            }

            if (strlen($value) >= 2 && (
                ($value[0] === '"' && $value[-1] === '"')
                || ($value[0] === "'" && $value[-1] === "'")
            )) {
                $value = substr($value, 1, -1);
            }

            if (getenv($key) === false) {
                putenv($key . '=' . $value);
            }
        }

        return $valid;
    }

    public static function get(string $key, string $default = ''): string
    {
        $value = getenv($key);
        return $value === false ? $default : $value;
    }
}
