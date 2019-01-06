<?php

namespace Modules\Video\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Video\Events\Handlers\RegisterVideoSidebar;

class VideoServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        $this->app->extend('asgard.ModulesList', function($app) {
            array_push($app, 'video');
            return $app;
        });

        $this->app['events']->listen(
            BuildingSidebar::class,
            $this->getSidebarClassForModule('Video', RegisterVideoSidebar::class)
        );
    }

    public function boot()
    {
        $this->publishConfig('video', 'permissions');
        $this->publishConfig('video', 'config');
        $this->publishConfig('video', 'settings');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Video\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Video\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Video\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Video\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Video\Repositories\MediaRepository',
            function () {
                $repository = new \Modules\Video\Repositories\Eloquent\EloquentMediaRepository(new \Modules\Video\Entities\Media());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Video\Repositories\Cache\CacheMediaDecorator($repository);
            }
        );
// add bindings


    }
}
