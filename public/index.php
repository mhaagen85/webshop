<?php

use Core\Application;
use Core\Request;

// require Autoloader
require_once($_SERVER['DOCUMENT_ROOT'] . '/../app/Core/Autoloader.php');
// require Setup scripts
require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/Setup/Setup.php");
// start application
$app = New Application(New Request);
$app->run();