<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        $this->appLanguage();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Set app language
     *
     * @return void
     */
    private function appLanguage()
    {
        if (!$lang = Cookie::get('chose_language')) {
            return;
        }

        if (!key_exists($lang, ['en', 'ua'])) {
            return;
        }

        app()->lang = $lang;
    }
}
