<?php

namespace IvanAquino\LaravelCredithub\Commands;

use Illuminate\Console\Command;

class LaravelCredithubCommand extends Command
{
    public $signature = 'laravel-credithub';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
