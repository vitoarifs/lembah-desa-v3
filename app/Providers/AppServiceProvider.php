<?php

namespace App\Providers;

use App\Models\SiteIdentity;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        if (! Schema::hasTable('site_identities')) {
            return;
        }

        $siteIdentity = SiteIdentity::getSettings();

        if (! $siteIdentity) {
            return;
        }

        // SiteIdentity → konfigurasi email Laravel
        Config::set('mail.from.address', $siteIdentity->email);
        Config::set('mail.from.name', $siteIdentity->nama_website);

        // Bagikan SiteIdentity ke seluruh tampilan Blade
        View::composer('*', function ($view) use ($siteIdentity) {
            $view->with('siteIdentity', $siteIdentity);
        });
    }
}
