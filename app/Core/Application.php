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
    protected $request;

    /**
     * 
     * @var Router
     */
    protected $router;

    /**
     * 
     * @param Request $request 
     * @param Router $router 
     * @return void 
     */
    public function __construct(
        Request $request
    )
    {
        $this->request = $request;
        $this->router = Router::load('Routes.php');
    }
    
    /**
     * 
     * @return void 
     */
    public function run()
    {
        $this->router->resolve($this->request);
    }
}