<?php

$router->add('/', function() {
    return 'Hello homepage';
}, "GET");

$router->add('/test', function() {
    return 'Hello test';
}, "GET");

$router->add('/product/{id}', function($params) {
    return 'Hello product with ID: ' . $params['id'];
}, 'GET');