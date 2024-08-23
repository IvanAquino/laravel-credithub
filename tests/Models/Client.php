<?php

namespace IvanAquino\LaravelCredithub\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use IvanAquino\LaravelCredithub\Contracts\HasCredits;
use IvanAquino\LaravelCredithub\Traits\CreditTransactional;

class Client extends Model implements HasCredits
{
    use CreditTransactional;

    protected $fillable = ['name'];
}
