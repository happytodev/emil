<?php

namespace Happytodev\Emil;

use Happytodev\Emil\Commands\EmilCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Happytodev\Emil\Console\GenerateSite;
use Happytodev\Emil\Console\InstallEmilPackage;

class EmilServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Install typhoon command
            $this->commands([
                InstallEmilPackage::class,
                GenerateSite::class
            ]);

            $this->publishes([
                __DIR__ . '/../_html' => base_path('_html'),
                __DIR__ . '/../content' => base_path('content'),
            ], 'emil-install-folders');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views'),
            ], 'emil-publish-layouts');
        }
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('emil')
            ->hasConfigFile()
            ->hasViews();
    }
}
