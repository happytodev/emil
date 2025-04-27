<?php

namespace Happytodev\Emil;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Happytodev\Emil\Commands\EmilCommand;

class EmilServiceProvider extends PackageServiceProvider
{
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
            ->hasViews()
            ->hasMigration('create_emil_table')
            ->hasCommand(EmilCommand::class);
    }
}
