<?php
/**
 * Created by PhpStorm.
 * User: ff
 * Date: 12/1/18
 * Time: 5:19 PM
 */

namespace App\Http\Middleware;


use Closure;
use App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;


class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $raw_locale = Session::get('locale');

        if (in_array($raw_locale, ['ua', 'en'])) {
            $locale = $raw_locale;
        } else {
            $locale = Config::get('app.locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}