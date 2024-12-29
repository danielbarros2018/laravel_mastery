<?php

namespace App\Http\Middleware;

use App\Models\Event;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserCanEditEventMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $event = Event::find($request->route()->parameter('event'));
        if (!auth()->user()->events->contains($event)) {
            abort(403, 'Usuário não pode acessar este evento.');
        }
        return $next($request);
    }
}
