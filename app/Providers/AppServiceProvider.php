<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (app()->runningInConsole()) {
            return;
        }

        try {
            if (Schema::hasTable('settings')) {
                View::composer('*', function ($view) {
                    if (!View::shared('settings')) {
                        $view->with('settings', Setting::first());
                    }
                });
            }
        } catch (\Throwable $e) {
            // Evita que el arranque falle si la BD no está disponible.
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RedirectIfAuthenticated::redirectUsing(function () {
            return route('cover');
        });
    }
}
