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
            require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        } else {
            // Add other classes
            require dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

            // Other example method
//            $file = dirname(__DIR__, 1) . '/'  . $className . '.php';
//            $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
//            if (file_exists($file)) {
//                include $file;
//            }
        }
    }
}

spl_autoload_register('Core\AutoLoader::autoLoadClass');
session_start();
