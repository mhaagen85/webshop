<?php

$router->add('/', function() {
    $loginController = new \Controllers\LoginController();
    $loginController->view('login');
}, "GET");

$router->add('/productlist', function() {
    $productListController = new \Controllers\ProductListController();
    $productListController->view();
}, "GET");

$router->add('/product/{id}', function($params) {
    return 'Hello product with ID: ' . $params['id'];
}, 'GET');

$router->add('/login', function() {
    $loginController = new \Controllers\LoginController();
    $loginController->login();
}, 'POST');

$router->add('/register', function() {
    $userController = new \Controllers\UserController();
    $userController->view('register');
}, 'GET');

$router->add('/create-user', function() {
    $userController = new \Controllers\UserController();
    $userController->create();
}, 'POST');

