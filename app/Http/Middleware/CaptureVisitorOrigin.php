<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CaptureVisitorOrigin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('source')) {
            // If the referrer is set and not from the same domain
            if ($request->headers->get('referer') && parse_url($request->headers->get('referer'), PHP_URL_HOST) !== $request->getHttpHost()) {
                session(['source' => $request->headers->get('referer')]);
            }
            elseif ($request->query('utm_source')) {
                session(['source' => 'utm_source:' . $request->query('utm_source')]);
            }
        }

        return $next($request);
    }
}
