<?php

return [

    'collectors' => [
    // ... outros coletores
    \App\Collectors\ApiMetricsCollector::class,
],
    /*
     * A coleção de coletores que deve ser registrada.
     */
    'collectors' => [
        \Spatie\Prometheus\Collectors\Horizon\CurrentMasterSupervisorCollector::class,
        \Spatie\Prometheus\Collectors\Horizon\CurrentProcessesPerQueueCollector::class,
        \Spatie\Prometheus\Collectors\Horizon\CurrentWorkloadCollector::class,
        \Spatie\Prometheus\Collectors\Horizon\FailedJobsPerHourCollector::class,
        \Spatie\Prometheus\Collectors\Horizon\RecentJobsCollector::class,
        \Spatie\Prometheus\Collectors\Http\ScheduledTaskCollector::class,
        \Spatie\Prometheus\Collectors\Http\RequestCollector::class,
        \Spatie\Prometheus\Collectors\Database\QueryCollector::class,
    ],

    /*
     * O caminho onde as métricas serão disponibilizadas.
     */
    'metrics_path' => '/metrics',

    /*
     * O servidor que será usado para armazenar as métricas.
     */
    'metrics_server' => env('PROMETHEUS_METRICS_SERVER', '127.0.0.1:9090'),

    /*
     * O adaptador que será usado para armazenar as métricas.
     */
    'storage_adapter' => env('PROMETHEUS_STORAGE_ADAPTER', \Prometheus\Storage\InMemory::class),

    /*
     * O namespace que será usado para as métricas.
     */
    'namespace' => env('PROMETHEUS_NAMESPACE', 'laravel'),
];
