<?php
namespace WoI\Core;

class View
{
    public static function render($view, $data = array())
    {
        $view = str_replace('\\', '/', $view);
        $file = realpath(APP_PATH . '/Views/' . $view . '.php');
        $viewRoot = realpath(APP_PATH . '/Views');

        if ($file === false || $viewRoot === false || strpos($file, $viewRoot . DIRECTORY_SEPARATOR) !== 0) {
            throw new \RuntimeException('View not found: ' . $view);
        }
        if (!is_array($data)) {
            throw new \InvalidArgumentException('View data must be an array.');
        }

        extract($data, EXTR_SKIP);
        require $file;
    }
}
