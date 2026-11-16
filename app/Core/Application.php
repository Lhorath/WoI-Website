<?php
namespace WoI\Core;

class Application
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();
        $registerRoutes = require ROOT_PATH . '/routes/web.php';
        if (is_callable($registerRoutes)) {
            $registerRoutes($this->router);
        }
    }

    public function run()
    {
        $this->router->dispatch();
    }
}
