<?php

/**
 * Inspired by: 
 *  https://github.com/Rareloop/router
 *  https://laracasts.com/series/php-for-beginners/episodes/16
 */

namespace Core;

use Core\Request;
use Closure;
use Exception;

class Router
{
    private $routes = [];

    /**
     * Load the routes 
     * and return and instance of the Router class using "Late Static Binding"
     */
    public static function load($file)
    {
        $router = New static;
        require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'Core/' . $file;

        return $router;
    }

    /**
     * Method for adding routes
     * 
     * @param string $uri 
     * @param Closure $callback 
     * @param string $method 
     * @return void 
     */
    public function add(string $uri, Closure $callback, string $method)
    {
        $this->routes[$uri] = [
            'callback' => $callback,
            'method' => $method,
        ];
    }

    /**
     * Resolves a route
     */
    public function resolve(Request $request)
    {
        $uri = explode('?',$request->requestUri)[0];
        if(array_key_exists($uri, $this->routes)) {
            $matchedRoute = $this->routes[$uri];
            $response = call_user_func($matchedRoute['callback']);
            echo $response;
        } else {
            throw New Exception('Route not found...');
        }
    }
}
