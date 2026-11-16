<?php
namespace WoI\Controllers;

use WoI\Core\Controller;

abstract class LegacyController extends Controller
{
    protected function renderLegacy($relativePath)
    {
        $root = realpath(ROOT_PATH);
        $file = realpath(ROOT_PATH . '/' . ltrim($relativePath, '/'));

        if ($root === false || $file === false || !is_file($file) || strpos($file, $root . DIRECTORY_SEPARATOR) !== 0) {
            (new ErrorController())->notFound();
            return;
        }

        // Recreate the original script context for legacy path calculations.
        $scriptPath = '/' . str_replace(DIRECTORY_SEPARATOR, '/', ltrim($relativePath, '/'));
        $_SERVER['PHP_SELF'] = $scriptPath;
        $_SERVER['SCRIPT_NAME'] = $scriptPath;
        $_SERVER['SCRIPT_FILENAME'] = $file;

        // Legacy scripts rely on paths relative to their original directory.
        chdir(dirname($file));
        require $file;
    }
}
