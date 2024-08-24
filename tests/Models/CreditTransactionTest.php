<?php

use IvanAquino\LaravelCredithub\Models\CreditTransaction;
use IvanAquino\LaravelCredithub\Tests\Enums\CreditType;

test('model must exists', function () {
    $model = CreditTransaction::factory()->create();

    $this->assertModelExists($model);
});

test('model must cast type field', function () {
    config()->set('credithub.type_field', CreditType::class);
    expect(config('credithub.type_field'))->toBe(CreditType::class);

    $model = CreditTransaction::factory()->create([
        'type' => CreditType::bought,
    ]);

    $this->assertModelExists($model);
    expect($model->type)->toBe(CreditType::bought);
});

test('type field can\'t be casted to a non enum type', function () {
    config()->set('credithub.type_field', CreditType::class);
    expect(config('credithub.type_field'))->toBe(CreditType::class);

    $model = CreditTransaction::factory()->create([
        'type' => 'other',
    ]);
})->throws(ValueError::class);
