<?php

namespace App\Providers;

use App\Models\Adressen;
use App\Models\Contactpersonen;
use App\Models\Bedrijven;
use App\Observers\ModelChangeObserver;
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
        Adressen::observe(ModelChangeObserver::class);
        Contactpersonen::observe(ModelChangeObserver::class);
        Bedrijven::observe(ModelChangeObserver::class);
    }
}
