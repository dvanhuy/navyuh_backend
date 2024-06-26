<?php

namespace App\Providers;

use App\Http\Middleware\IsLogin;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Broadcast::routes([
        //     'prefix' => 'api',
        // ]);
        require base_path('routes/channels.php');
    }
}
