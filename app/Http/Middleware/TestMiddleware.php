<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
           // Check if a user with the first name "Adnan" exists
    if (User::where('firstName', 'Adnan')->exists()) {
        return $next($request);
    }

    // Redirect if the user is not found
    return redirect('/userLogin');
    }
}
