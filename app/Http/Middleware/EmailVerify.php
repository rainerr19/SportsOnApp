<?php
use Illuminate\Support\Facades\Auth;
namespace App\Http\Middleware;

use Closure;

class EmailVerify
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
        //dd($request->user());
        // Auth::logout();
        if (! $request->user()->verify) {
            return redirect()->route('verify');
            
         }
        return $next($request);
    }
}
