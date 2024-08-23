<?php

namespace IvanAquino\LaravelCredithub\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use IvanAquino\LaravelCredithub\LaravelCredithubServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'IvanAquino\\LaravelCredithub\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelCredithubServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-credithub_table.php.stub';
        $migration->up();
        */
    }
}
