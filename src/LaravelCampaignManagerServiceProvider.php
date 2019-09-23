<?php

namespace Drivezy\LaravelCampaignManager;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelCampaignManagerServiceProvider
 * @package Drivezy\LaravelCampaignManager
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class LaravelCampaignManagerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot ()
    {
        /**
         * load routes defined out here
         */
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        /**
         * Load migrations as part of this package
         */
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
