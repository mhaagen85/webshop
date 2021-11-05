<?php

// Home
$router->add('/', function() {
    $homeController = new \Controllers\HomeController();
    $homeController->view('home');
}, "GET");

// Product
$router->add('/productlist', function () {
    $productListController = new \Controllers\ProductController();
    $productListController->view('index');
}, "GET");

$router->add('/product-form', function() {
    $productListController = new \Controllers\ProductController();
    $productListController->view('add-form');
}, 'GET');

$router->add('/create-product', function() {
    $productController = new \Controllers\ProductController();
    $productController->create();
}, 'POST');

$router->add('/delete-product', function() {
    $productController = new \Controllers\ProductController();
    $productController->delete();
}, 'POST');

// User
$router->add('/login', function() {
    $loginController = new \Controllers\LoginController();
    $loginController->view('login');
}, 'GET');

$router->add('/logout', function() {
    $loginController = new \Controllers\LoginController();
    $loginController->logout();
}, 'GET');

$router->add('/login-user', function() {
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

