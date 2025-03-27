<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Prometheus\CollectorRegistry;
use Symfony\Component\HttpFoundation\Response;

class TrackApiMetrics
{
    public function __construct(
        private CollectorRegistry $registry
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $start = microtime(true);
        
        $response = $next($request);
        
        $duration = microtime(true) - $start;
        
        $route = $request->route();
        $path = $route?->uri() ?? $request->path();
        
        $this->registry->getCounter(
            config('prometheus.namespace'),
            'api_requests_total'
        )->inc([
            $request->method(),
            $path,
            $response->getStatusCode()
        ]);
        
        $this->registry->getHistogram(
            config('prometheus.namespace'),
            'api_response_time_seconds'
        )->observe($duration, [
            $request->method(),
            $path
        ]);
        
        return $response;
    }
}