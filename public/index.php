<?php

use Core\Application;
use Core\Autoloader;
use Core\Request;
use Core\Router;


require_once($_SERVER['DOCUMENT_ROOT'] . '/../app/Core/Autoloader.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/Setup/Setup.php");

$app = New Application(New Request);
$app->run();