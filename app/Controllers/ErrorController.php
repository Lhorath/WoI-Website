<?php
namespace WoI\Controllers;

class ErrorController
{
    public function notFound()
    {
        if (!headers_sent()) {
            http_response_code(404);
        }
        chdir(ROOT_PATH);
        $file = ROOT_PATH . '/utility/errors/404.php';
        if (is_file($file)) {
            require $file;
            return;
        }
        echo '404 - Page not found.';
    }
}
