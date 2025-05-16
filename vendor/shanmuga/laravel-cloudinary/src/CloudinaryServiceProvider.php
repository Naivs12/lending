<?php

/**
 * This file is part of Laravel Cloudinary,
 * Cloudinary wrapper for Laravel Application.
 *
 * @license     MIT
 * @package     Shanmuga\LaravelCloudinary
 * @category    Provider
 * @author      Shanmugarajan
 */

namespace Shanmuga\LaravelCloudinary;

use Illuminate\Support\ServiceProvider;
use Cloudinary;

class CloudinaryServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/cloudinary.php' => config_path('cloudinary.php'),
        ],'LaravelCloudinary');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/cloudinary.php', 'cloudinary'
        );

        $this->app->bind('laravel_cloudinary', function ($app) {
            return new LaravelCloudinary($app);
        });

        $this->app->alias('LaravelCloudinary', 'Shanmuga\Cloudinary\Facades\CloudinaryFacade');
    }
}
