<?php

namespace Core;

class Autoloader 
{
    public static function autoLoadClass(string $className)
    {
        require dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    }
}

spl_autoload_register('Core\AutoLoader::autoLoadClass');

