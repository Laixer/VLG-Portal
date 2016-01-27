<?php

namespace App\Http\Middleware;

use Closure;
use App\Application;
use App\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if ($request->get('token') && $request->get('endpoint') && $request->get('timestamp') && $request->get('auth')) {
                if ($request->get('timestamp') > (time()-900) && $request->get('timestamp') < (time()+2) && $request->get('auth') == 'jwtgssauth') {
                    $app = Application::where('public_token', $request->get('token'))->where('domain', $request->get('endpoint'))->first();

                    $endpoint = $app->getEndpointUrl();

                    $audit = new Audit;
                    $audit->payload = 'SSO via ' . $app->domain;
                    $audit->user_id = Auth::id();
                    $audit->save();

                    return redirect($endpoint);
                }
            }

            return redirect('/');
        }

        return $next($request);
    }
}
