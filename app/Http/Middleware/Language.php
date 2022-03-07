<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;
use App;

class language
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

    		// if(Session::has('locale')){
    		// 	$locale = Session::get('locale', Config::get('app.locale'));
    		// }else{
        //   // Default
        //   $locale = 'en';
    		// }
        if(!Session::has('lang_id')) {
          $request->session()->put('lang_id', 44);
          $request->session()->put('direction', 0);
        }

    		App::setLocale($request->session()->get('locale'));
        
        return $next($request);
    }
}
