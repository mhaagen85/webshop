<?php

$router->add('/', function() {
    return 'Hello homepage';
}, "GET");

$router->add('/productlist', function() {
    $productListController = new \Controllers\ProductListController();
    $productListController::view();
}, "GET");

$router->add('/product/{id}', function($params) {
    return 'Hello product with ID: ' . $params['id'];
}, 'GET');