<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        // Menambahkan aturan singularisasi kustom
        Str::macro('singularStudly', function ($value) {
            // Aturan kustom untuk bahasa Indonesia
            if ($value === 'berita') {
                return 'berita';
            }

            // Jalankan logika singularisasi default untuk kata lain
            return Str::of($value)->singular()->studly();
        });
    }
}
