<?php

test('credits can be added to models', function () {
    $user = \IvanAquino\LaravelCredithub\Tests\Models\User::create(['name' => 'Ivan']);
    $transaction = $user->addCredits(100, 'test', ['foo' => 'bar']);

    $this->assertModelExists($transaction);
    expect($user->credit_balance)->toBe(100)
        ->and($user->has_credits)->toBeTrue();

    $client = \IvanAquino\LaravelCredithub\Tests\Models\Client::create(['name' => 'Client']);
    $transaction2 = $client->addCredits(100, 'test', ['foo' => 'bar']);

    $this->assertModelExists($transaction2);
    expect($client->credit_balance)->toBe(100)
        ->and($client->has_credits)->toBeTrue();
});

test('verify addCredits and subtractCredits methods', function () {
    $user = \IvanAquino\LaravelCredithub\Tests\Models\User::create(['name' => 'Ivan']);

    expect($user->credit_balance)->toBe(0)
        ->and($user->has_credits)->toBeFalse();

    $user->addCredits(100, 'test', ['foo' => 'bar']);
    $user->subtractCredits(50, 'test', ['foo' => 'bar']);
    $user->addCredits(25, 'test', ['foo' => 'bar']);
    $user->subtractCredits(10, 'test', ['foo' => 'bar']);

    expect($user->credit_balance)->toBe(65)
        ->and($user->has_credits)->toBeTrue();
});

test('credits can be transferred between models', function () {
    $user = \IvanAquino\LaravelCredithub\Tests\Models\User::create(['name' => 'Ivan']);
    $client = \IvanAquino\LaravelCredithub\Tests\Models\Client::create(['name' => 'Client']);

    expect($user->credit_balance)->toBe(0)
        ->and($user->has_credits)->toBeFalse()
        ->and($client->credit_balance)->toBe(0)
        ->and($client->has_credits)->toBeFalse();

    $user->addCredits(100, 'test', ['foo' => 'bar']);
    $user->transferCreditsTo($client, 25, 'test', ['foo' => 'bar']);

    expect($user->credit_balance)->toBe(75)
        ->and($user->has_credits)->toBeTrue()
        ->and($client->credit_balance)->toBe(25)
        ->and($client->has_credits)->toBeTrue();
});

test('if model has not enough credits, it should not be able to subtract', function () {
    $user = \IvanAquino\LaravelCredithub\Tests\Models\User::create(['name' => 'Ivan']);

    expect($user->credit_balance)->toBe(0)
        ->and($user->has_credits)->toBeFalse();

    $user->addCredits(100, 'test', ['foo' => 'bar']);

    expect($user->credit_balance)->toBe(100)
        ->and($user->has_credits)->toBeTrue();

    $user->subtractCredits(50, 'test', ['foo' => 'bar']);
    $user->subtractCredits(100, 'test', ['foo' => 'bar']);
})->throws(\IvanAquino\LaravelCredithub\Exceptions\NotEnoughCreditsException::class);

test('if model has not enough credits, it should not be able to transfer', function () {
    $user = \IvanAquino\LaravelCredithub\Tests\Models\User::create(['name' => 'Ivan']);
    $client = \IvanAquino\LaravelCredithub\Tests\Models\Client::create(['name' => 'Client']);

    expect($user->credit_balance)->toBe(0)
        ->and($user->has_credits)->toBeFalse()
        ->and($client->credit_balance)->toBe(0)
        ->and($client->has_credits)->toBeFalse();

    $user->addCredits(100, 'test', ['foo' => 'bar']);

    expect($user->credit_balance)->toBe(100)
        ->and($user->has_credits)->toBeTrue()
        ->and($client->credit_balance)->toBe(0)
        ->and($client->has_credits)->toBeFalse();

    $user->transferCreditsTo($client, 50, 'test', ['foo' => 'bar']);
    $user->transferCreditsTo($client, 100, 'test', ['foo' => 'bar']);
})->throws(\IvanAquino\LaravelCredithub\Exceptions\NotEnoughCreditsException::class);
