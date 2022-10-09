<?php

namespace SimosFasouliotis\ImageToWebp\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ImageToWebpProvider
 *
 * @package SimosFasouliotis\ImageToWebp\Providers
 */
class ImageToWebpProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/imageToWebp.php' => config_path('imageToWebp.php'),
            ], 'config');

        }
    }

    /**
     *
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/imageToWebp.php', 'imageToWebp');
    }
}
