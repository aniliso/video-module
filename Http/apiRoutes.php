<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'media'], function (Router $router) {
    $router->get('media', [
       'as'          => 'api.media.get',
       'uses'        => 'MediaController@get'
    ]);
    $router->get('embed', [
        'as'         => 'api.media.getEmbed',
        'uses'       => 'MediaController@getEmbed'
    ]);
});
