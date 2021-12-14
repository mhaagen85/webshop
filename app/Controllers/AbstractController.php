<?php

namespace Controllers;

use Models\User;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

abstract class AbstractController
{
    /**
     * @param $path
     * @return mixed
     */
    abstract function view($path);

    /**
     * @param $data
     */
    public function renderTemplate($data)
    {
        $mustacheEngine = new Mustache_Engine(['loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__, 3) . '/views')]);
        $data['user'] = User::isLoggedIn();

        echo $mustacheEngine->render($data['template'], ['data' => $data]);
    }

    /**
     * @param $path
     */
    public function redirect($path)
    {
        header('Location: ' . $path);
        exit;
    }

}