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

        // Keep the working directory aligned with the original script location.
        chdir(dirname($file));
        require $file;
    }
}
