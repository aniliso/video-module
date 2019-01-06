<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/video'], function (Router $router) {
    $router->bind('videoCategory', function ($id) {
        return app('Modules\Video\Repositories\CategoryRepository')->find($id);
    });
    $router->get('categories', [
        'as' => 'admin.video.category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:video.categories.index'
    ]);
    $router->get('categories/create', [
        'as' => 'admin.video.category.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:video.categories.create'
    ]);
    $router->post('categories', [
        'as' => 'admin.video.category.store',
        'uses' => 'CategoryController@store',
        'middleware' => 'can:video.categories.create'
    ]);
    $router->get('categories/{videoCategory}/edit', [
        'as' => 'admin.video.category.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:video.categories.edit'
    ]);
    $router->put('categories/{videoCategory}', [
        'as' => 'admin.video.category.update',
        'uses' => 'CategoryController@update',
        'middleware' => 'can:video.categories.edit'
    ]);
    $router->delete('categories/{videoCategory}', [
        'as' => 'admin.video.category.destroy',
        'uses' => 'CategoryController@destroy',
        'middleware' => 'can:video.categories.destroy'
    ]);
    $router->bind('videoMedia', function ($id) {
        return app('Modules\Video\Repositories\MediaRepository')->find($id);
    });
    $router->get('media', [
        'as' => 'admin.video.media.index',
        'uses' => 'MediaController@index',
        'middleware' => 'can:video.media.index'
    ]);
    $router->get('media/create', [
        'as' => 'admin.video.media.create',
        'uses' => 'MediaController@create',
        'middleware' => 'can:video.media.create'
    ]);
    $router->post('media', [
        'as' => 'admin.video.media.store',
        'uses' => 'MediaController@store',
        'middleware' => 'can:video.media.create'
    ]);
    $router->get('media/{videoMedia}/edit', [
        'as' => 'admin.video.media.edit',
        'uses' => 'MediaController@edit',
        'middleware' => 'can:video.media.edit'
    ]);
    $router->put('media/{videoMedia}', [
        'as' => 'admin.video.media.update',
        'uses' => 'MediaController@update',
        'middleware' => 'can:video.media.edit'
    ]);
    $router->delete('media/{videoMedia}', [
        'as' => 'admin.video.media.destroy',
        'uses' => 'MediaController@destroy',
        'middleware' => 'can:video.media.destroy'
    ]);
// append


});
