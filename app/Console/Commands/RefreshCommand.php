<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    protected $signature = 'app:refresh';

    protected $description = 'Рефреш проекта';

    public function handle()
    {
        if(app()->isProduction()){
            $this->error('Доступно только при локальной разработке.');

            return self::FAILURE;
        }

        Storage::deleteDirectory('images/products');

        $this->call('migrate:fresh', [
            '--seed' => true
        ]);

        $this->info('Приложение успешно зарефрешено.');

        return $this::SUCCESS;
    }
}
