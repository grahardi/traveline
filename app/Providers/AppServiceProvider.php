<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        // Situs ini pakai Bootstrap 5 (CDN), bukan Tailwind — pakai view pagination kustom
        // supaya tombol next/prev tidak "bugs" (tampilan default Laravel 13 memakai class Tailwind).
        Paginator::defaultView('pagination.bootstrap5');
    }
}
