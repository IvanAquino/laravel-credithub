<?php

test('user must exist', function () {
    $model = \IvanAquino\LaravelCredithub\Tests\Models\User::create(['name' => 'Ivan']);

    $this->assertModelExists($model);
});

test('client must exist', function () {
    $model = \IvanAquino\LaravelCredithub\Tests\Models\Client::create(['name' => 'Ivan']);

    $this->assertModelExists($model);
});
