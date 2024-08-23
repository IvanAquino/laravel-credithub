<?php

namespace IvanAquino\LaravelCredithub\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
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
        Relation::enforceMorphMap([
            'users' => 'IvanAquino\LaravelCredithub\Tests\Models\User',
            'clients' => 'IvanAquino\LaravelCredithub\Tests\Models\Client',
        ]);

        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_credit_transaction_table.php.stub';
        $migration->up();

        $this->createTestModelTables();
    }

    public function createTestModelTables(): void
    {
        collect(['users', 'clients'])->each(function ($table) {
            Schema::create($table, function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->timestamps();
            });
        });
    }
}
