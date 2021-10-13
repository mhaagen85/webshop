<?php

namespace Controllers;

use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

abstract class AbstractController
{
    public static function renderTemplate($template, $data)
    {
        $mustacheEngine = new Mustache_Engine(['loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/../views')]);
        echo $mustacheEngine->render($template, ['data' => $data]);
    }
}