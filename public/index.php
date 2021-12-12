<?php

use Core\Application;
use Core\Request;

// require Autoloader
require_once($_SERVER['DOCUMENT_ROOT'] . '/../app/Core/Autoloader.php');

// start application
$app = New Application(New Request);
$app->run();