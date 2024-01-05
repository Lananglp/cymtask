<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class PengunjungWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $pengunjung = 'total_pengunjung';

        if (!Cache::has($pengunjung)) {
            Cache::put($pengunjung, 1, now()->addHours(24));
        } else {
            Cache::increment($pengunjung);
        }
        

        return $next($request);
    }
}
