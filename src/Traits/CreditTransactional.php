<?php

namespace IvanAquino\LaravelCredithub\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use IvanAquino\LaravelCredithub\Contracts\HasCredits;
use IvanAquino\LaravelCredithub\Exceptions\NotEnoughCreditsException;
use IvanAquino\LaravelCredithub\Models\CreditTransaction;

trait CreditTransactional
{
    protected function creditBalance(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->creditTransactions()->sum('amount'),
        );
    }

    protected function hasCredits(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->credit_balance > 0,
        );
    }

    public function creditTransactions(): MorphMany
    {
        return $this->morphMany(CreditTransaction::class, 'creditable');
    }

    public function addCredits(int $amount, $type = '', array $payload = []): CreditTransaction
    {
        return $this->creditTransactions()->create([
            'amount' => $amount,
            'type' => $type,
            'payload' => $payload,
        ]);
    }

    /**
     * @throws NotEnoughCreditsException
     */
    public function subtractCredits(int $amount, $type = '', array $payload = []): CreditTransaction
    {
        $amount = abs($amount) * -1;

        if ($this->credit_balance + $amount < 0) {
            throw new NotEnoughCreditsException;
        }

        return $this->creditTransactions()->create([
            'amount' => $amount,
            'type' => $type,
            'payload' => $payload,
        ]);
    }

    /**
     * @throws NotEnoughCreditsException
     */
    public function transferCreditsTo(HasCredits $model, int $amount, $type = '', $payload = []): CreditTransaction
    {
        $amount = abs($amount);

        if ($this->credit_balance - $amount < 0) {
            throw new NotEnoughCreditsException;
        }

        $this->subtractCredits($amount, $type, $payload);

        return $model->addCredits($amount, $type, $payload);
    }
}
