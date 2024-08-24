<?php

namespace IvanAquino\LaravelCredithub;

use IvanAquino\LaravelCredithub\Commands\LaravelCredithubCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelCredithubServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-credithub')
            ->hasConfigFile()
            ->hasMigrations('create_credit_transaction_table');
        // ->hasCommand(LaravelCredithubCommand::class);
    }
}
