<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;
use Route;
use App;
use Illuminate\Support\Facades\Auth;


class UserAuthorized
{
    public function handle($request, Closure $next) {
        // Escape routes
        $escape_routes = ['login', 'main', 'musician.singer', 'model.actor', 'dancer.athlete', 'writer.director', 'artist.designer', 'freelancer', 'property', 'company', 'marketplace', 'get.profile.overview', 'get.profile.basic.info', 'edit.profile.picture', 'get.profile.media', 'get.profile.music'];
        if (!in_array($request->route()->getName(), $escape_routes)) {
            if(!Auth::guard('user')->check()) {
                return redirect(route('login'));
            }
        }

        return $next($request);
    }
}
