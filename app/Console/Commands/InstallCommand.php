<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'app:install';

    protected $description = 'Произвести действия для развёртывания проекта';

    public function handle()
    {
        $this->call('storage:link');
        $this->call('migrate');

        return self::SUCCESS;
    }
}
