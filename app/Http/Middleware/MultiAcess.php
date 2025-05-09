<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MultiAcess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || !$user->accessRole || (!$user->accessRole->regional && !$user->accessRole->gerentes && !$user->accessRole->supervisor && !$user->accessRole->admin && !$user->accessRole->root)) {

            return redirect()->route('home')->with('error', 'Você não possuí acesso a essa página!');
        }

        return $next($request);
    }
}
