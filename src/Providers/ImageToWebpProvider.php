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
    }
}
