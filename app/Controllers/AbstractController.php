<?php

namespace Controllers;

use Models\User;
use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

abstract class AbstractController
{
    /**
     * @var
     */
    protected $mustacheEngine;

    /**
     * @param $path
     * @return mixed
     */
    abstract function view($path);

    /**
     * @param $template
     * @param $data
     */
    public function renderTemplate($template, $data)
    {
        $this->mustacheEngine = new Mustache_Engine(['loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/../views')]);
        $data['user'] = User::isLoggedIn();

        echo $this->mustacheEngine->render($template, ['data' => $data]);
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