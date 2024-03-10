<?php

namespace Happytodev\Emil;

use Happytodev\Emil\Console\GenerateSite;
use Happytodev\Emil\Console\InstallEmilPackage;
use Happytodev\Emil\Console\ServeEmilSite;
use Happytodev\Emil\Console\WatchChange;
use Happytodev\Emil\Console\WatchTailwind;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EmilServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            // List Emil available commands
            $this->commands([
                GenerateSite::class,
                InstallEmilPackage::class,
                ServeEmilSite::class,
                WatchTailwind::class,
                WatchChange::class,
            ]);

            $this->publishes([
                __DIR__.'/../_html' => base_path('_html'),
                __DIR__.'/../content' => base_path('content'),
            ], 'emil-install-folders');

            $this->publishes([
                __DIR__.'/../resources' => base_path('resources'),
            ], 'emil-publish-layouts');

            $this->publishes([
                __DIR__.'/../tailwind.config.js' => base_path('tailwind.config.js'),
                __DIR__.'/../package.json' => base_path('package.json'),
                __DIR__.'/../package-lock.json' => base_path('package-lock.json'),
                __DIR__.'/../postcss.config.js' => base_path('postcss.config.js'),
            ], 'emil-publish-tailwind-components');
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
