<?php

use IvanAquino\LaravelCredithub\Models\CreditTransaction;

test('model must exists', function () {
    $model = CreditTransaction::factory()->create();

    $this->assertModelExists($model);
});
