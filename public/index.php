<?php

use Core\Application;
use Core\Request;
use Core\Database;

// require Autoloader
require_once($_SERVER['DOCUMENT_ROOT'] . '/../app/Core/Autoloader.php');
// Run Migrations
$db = new Database();
$db->applyMigrations();
// start application
$app = New Application(New Request);
$app->run();