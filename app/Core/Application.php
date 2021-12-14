<?php

namespace Core;

use Core\Request;
use Core\Router;

class Application
{
    /**
     * 
     * @var Request
     */
    protected Request $request;

    /**
     * 
     * @var Router
     */
    protected Router $router;

    /**
     * @param \Core\Request $request
     */
    public function __construct(
        Request $request
    )
    {
        $this->request = $request;
        $this->router = Router::load('Routes.php');
    }

    /**
     * @throws \Exception
     */
    public function run()
    {
        $this->router->resolve($this->request);
    }
}