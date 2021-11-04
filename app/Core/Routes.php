<?php

// Home
$router->add('/', function() {
    $loginController = new \Controllers\LoginController(new \Models\User());
    $loginController->view('login');
}, "GET");

// Product
$router->add('/productlist', function() {
    $productListController = new \Controllers\ProductController(new \Models\Product());
    $productListController->view('index');
}, "GET");

$router->add('/product-form', function() {
    $productListController = new \Controllers\ProductController(new \Models\Product());
    $productListController->view('add-form');
}, 'GET');

$router->add('/create-product', function() {
    $productController = new \Controllers\ProductController(new \Models\Product());
    $productController->create();
}, 'POST');

$router->add('/delete-product', function() {
    $productController = new \Controllers\ProductController(new \Models\Product());
    $productController->delete();
}, 'POST');

// User
$router->add('/login', function() {
    $loginController = new \Controllers\LoginController(new \Models\User());
    $loginController->view('login');
}, 'GET');

$router->add('/logout', function() {
    $loginController = new \Controllers\LoginController(new \Models\User());
    $loginController->logout();
}, 'GET');

$router->add('/login-user', function() {
    $loginController = new \Controllers\LoginController(new \Models\User());
    $loginController->login();
}, 'POST');

$router->add('/register', function() {
    $userController = new \Controllers\UserController(new \Models\User());
    $userController->view('register');
}, 'GET');

$router->add('/create-user', function() {
    $userController = new \Controllers\UserController(new \Models\User());
    $userController->create();
}, 'POST');

