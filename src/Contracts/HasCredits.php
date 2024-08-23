<?php

namespace IvanAquino\LaravelCredithub\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use IvanAquino\LaravelCredithub\Models\CreditTransaction;

interface HasCredits
{
    public function creditTransactions(): MorphMany;

    public function addCredits(int $amount, $type = '', array $payload = []): CreditTransaction;

    public function subtractCredits(int $amount, $type = '', array $payload = []): CreditTransaction;
}
