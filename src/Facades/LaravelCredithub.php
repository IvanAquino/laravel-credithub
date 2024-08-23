<?php

namespace IvanAquino\LaravelCredithub\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IvanAquino\LaravelCredithub\LaravelCredithub
 */
class LaravelCredithub extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \IvanAquino\LaravelCredithub\LaravelCredithub::class;
    }
}
