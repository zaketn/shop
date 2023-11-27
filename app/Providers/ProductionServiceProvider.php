<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class ProductionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (App::isProduction()) {
            $maxQueryDuration = CarbonInterval::second(10);
            DB::whenQueryingForLongerThan($maxQueryDuration, function (Connection $connection) use ($maxQueryDuration) {
                Log::channel('telegram')
                    ->debug("Запросы выполняются дольше $maxQueryDuration->seconds секунд: " . $connection->totalQueryDuration());
            });

            $maxSingleQueryDuration = 3;
            DB::listen(function ($query) use ($maxSingleQueryDuration) {
                if ($query->time > $maxSingleQueryDuration) {
                    Log::channel('telegram')
                        ->debug("Запрос длится дольше $maxSingleQueryDuration секунд: " . $query->sql, $query->bindings);
                }
            });

            $kernel = app(Kernel::class);

            $maxRequestDuration = CarbonInterval::second(5);
            $kernel->whenRequestLifecycleIsLongerThan(
                $maxRequestDuration,
                function () use ($maxRequestDuration) {
                    Log::channel('telegram')
                        ->debug("Жизненный цикл пользовательского запроса дольше $maxRequestDuration->seconds секунд: " . Request::url());
                }
            );
        }
    }
}
