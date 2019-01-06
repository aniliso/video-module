<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group([], function (Router $router) {
    $router->get(LaravelLocalization::transRoute('video::routes.media.show'), [
       'uses' => 'PublicController@show',
       'as'   => 'video.media.show'
    ]);
    $router->get(LaravelLocalization::transRoute('video::routes.media.index'), [
        'uses' => 'PublicController@index',
        'as'   => 'video.media.index'
    ]);
});
