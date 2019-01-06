<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group([], function (Router $router) {
    $router->get('video/{slug}', [
       'uses' => 'PublicController@show',
       'as'   => 'media.show'
    ]);
    $router->get('video', [
        'uses' => 'PublicController@index',
        'as'   => 'media.index'
    ]);
});
