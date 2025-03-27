<?php

namespace App\Collectors;

use Spatie\Prometheus\Collectors\Collector;
use Prometheus\CollectorRegistry;

class ApiMetricsCollector extends Collector
{
    public function register(CollectorRegistry $prometheusRegistry): void
    {
        $prometheusRegistry->getOrRegisterCounter(
            $this->namespace,
            'api_requests_total',
            'Total API requests',
            ['method', 'endpoint', 'status_code']
        );
        
        $prometheusRegistry->getOrRegisterHistogram(
            $this->namespace,
            'api_response_time_seconds',
            'API response time',
            ['method', 'endpoint'],
            [0.1, 0.5, 1, 2, 5]
        );
    }
}