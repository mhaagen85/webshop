<?php

namespace Core;

class Autoloader
{
    /**
     * @param string $className
     */
    public static function autoLoadClass(string $className)
    {
        // Add vendor classes
        if (strpos($className, '_')) {
            $className = 'vendor/' . str_replace("_", "/", $className);
            require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR,
                    $className) . '.php';
        }
        if (strpos($className, 'Symfony') !== false) {
            require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR,
                    'vendor/'. $className) . '.php';
        } else {
            // Add other classes
            require dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        }
    }
}

spl_autoload_register('Core\AutoLoader::autoLoadClass');
session_start();
