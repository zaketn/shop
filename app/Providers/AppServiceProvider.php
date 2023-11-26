<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::shouldBeStrict(app()->isProduction());

        DB::whenQueryingForLongerThan(500, function (Connection $connection) {
            Log::channel('telegram')->debug('whenQueryingForLongerThan: ' . $connection->query()->toSql());
        });

        $kernel = app(Kernel::class);

        $kernel->whenRequestLifecycleIsLongerThan(
            CarbonInterval::second(5),
            function () {
                Log::channel('telegram')->debug('whenRequestLifecycleIsLongerThan: ' . Request::url());
            }
        );
    }
}
