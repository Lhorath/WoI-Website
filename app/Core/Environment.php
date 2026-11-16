<?php
namespace WoI\Core;

class Environment
{
    private static $loadedFiles = array();

    public static function load($file)
    {
        $path = realpath($file);
        if ($path === false || isset(self::$loadedFiles[$path]) || !is_readable($path)) {
            return false;
        }

        self::$loadedFiles[$path] = true;
        $lines = file($path, FILE_IGNORE_NEW_LINES);
        if ($lines === false) {
            return false;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] === '#') {
                continue;
            }
            if (strpos($line, 'export ') === 0) {
                $line = substr($line, 7);
            }

            $position = strpos($line, '=');
            if ($position === false) {
                continue;
            }

            $name = trim(substr($line, 0, $position));
            $value = trim(substr($line, $position + 1));
            if ($name === '' || !preg_match('/^[A-Z_][A-Z0-9_]*$/i', $name)) {
                continue;
            }

            if (strlen($value) >= 2) {
                $first = $value[0];
                $last = substr($value, -1);
                if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                    $value = substr($value, 1, -1);
                    if ($first === '"') {
                        $value = str_replace(array('\\n', '\\r', '\\"', '\\\\'), array("\n", "\r", '"', '\\'), $value);
                    }
                } else {
                    $value = preg_replace('/\s+#.*$/', '', $value);
                }
            } else {
                $value = preg_replace('/\s+#.*$/', '', $value);
            }

            if (getenv($name) !== false) {
                continue;
            }
            putenv($name . '=' . $value);
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }

        return true;
    }

    public static function get($name, $default = null)
    {
        $value = getenv($name);
        return ($value === false || $value === '') ? $default : $value;
    }

    public static function boolean($name, $default = false)
    {
        $value = self::get($name, null);
        return $value === null ? (bool) $default : filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
