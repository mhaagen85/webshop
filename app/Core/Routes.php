<?php

$router->add('/', function() {
    $loginController = new \Controllers\LoginController();
    $loginController->view('login');
}, "GET");

$router->add('/productlist', function() {
    $productListController = new \Controllers\ProductController();
    $productListController->view('index');
}, "GET");

$router->add('/add-product-form', function() {
    $productListController = new \Controllers\ProductController();
    $productListController->view('add-form');
}, 'GET');

$router->add('/add-product', function() {
    $productController = new \Controllers\ProductController();
    $productController->create();
}, 'POST');

$router->add('/delete-product', function() {
    $productController = new \Controllers\ProductController();
    $productController->delete();
}, 'POST');

$router->add('/login', function() {
    $loginController = new \Controllers\LoginController();
    $loginController->view('login');
}, 'GET');

$router->add('/login-user', function() {
    $loginController = new \Controllers\LoginController();
    $loginController->login();
}, 'POST');

$router->add('/logout', function() {
    $loginController = new \Controllers\LoginController();
    $loginController->logout();
}, 'GET');

$router->add('/register', function() {
    $userController = new \Controllers\UserController();
    $userController->view('register');
}, 'GET');

$router->add('/create-user', function() {
    $userController = new \Controllers\UserController();
    $userController->create();
}, 'POST');

