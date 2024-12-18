<?php



namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;






class LanguageManager

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

        if (session()->has('current_lang')) {

            App::setLocale(session()->get('current_lang'));
        }



        return $next($request);
    }
}
