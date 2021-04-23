<?php

use Laminas\Db\Adapter\Adapter;

use LaminasDbProfiler\Collector\DbCollector;
use LaminasDbProfiler\Options\ModuleOptions;
use LaminasDbProfiler\Collector\Service\DbCollectorFactory;
use LaminasDbProfiler\Options\Service\ModuleOptionsFactory;

return [
    'service_manager' => [
        'factories' => [
            DbCollector::class => DbCollectorFactory::class,
            ModuleOptions::class => ModuleOptionsFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'laminas-db-profiler/toolbar/db' => __DIR__ . '/../view/laminas-db-profiler/toolbar/db.phtml',
        ],
    ],
    'laminas-developer-tools' => [
        'profiler' => [
            'collectors' => [
                'LaminasDbProfiler' => DbCollector::class,
            ],
        ],
        'toolbar' => [
            'entries' => [
                'LaminasDbProfiler' => 'laminas-db-profiler/toolbar/db',
            ],
        ],
    ],
    'laminas_db_profiler' => [
        'dbAdapterServiceManagerKey' => Adapter::class,
    ],
];
