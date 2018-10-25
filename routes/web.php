<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Comment Routes
$router->post('/comments', 'CommentController@create');
$router->get('/comments', 'CommentController@index');
$router->put('/comments/{id}', 'CommentController@update');
$router->delete('/comments/{id}', 'CommentController@delete');
