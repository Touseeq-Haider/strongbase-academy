<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Production mein (Render jaisi hosting pe) hamesha HTTPS URLs generate karna,
        // taake forms/links "not secure" warning na dikhayein
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
