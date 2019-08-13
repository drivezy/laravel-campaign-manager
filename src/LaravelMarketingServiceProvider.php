<?php

namespace Drivezy\LaravelMarketing;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelMarketingServiceProvider
 * @package Drivezy\LaravelMarketing
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class LaravelMarketingServiceProvider extends ServiceProvider {

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot () {
        /**
         * Load migrations as part of this package
         */
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}