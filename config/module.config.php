<?php

use Laminas\Db\Adapter\Adapter;

use StfnLaminasDbProfiler\Collector\DbCollector;
use StfnLaminasDbProfiler\Options\ModuleOptions;
use StfnLaminasDbProfiler\Collector\Service\DbCollectorFactory;
use StfnLaminasDbProfiler\Options\Service\ModuleOptionsFactory;

return [
    'service_manager' => [
        'factories' => [
            DbCollector::class => DbCollectorFactory::class,
            ModuleOptions::class => ModuleOptionsFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'stfn-laminas-db-profiler/toolbar/db' => __DIR__ . '/../view/stfn-laminas-db-profiler/toolbar/db.phtml',
        ],
    ],
    'laminas-developer-tools' => [
        'profiler' => [
            'collectors' => [
                'StfnLaminasDbProfiler' => DbCollector::class,
            ],
        ],
        'toolbar' => [
            'entries' => [
                'StfnLaminasDbProfiler' => 'stfn-laminas-db-profiler/toolbar/db',
            ],
        ],
    ],
    'stfn_laminas_db_profiler' => [
        'dbAdapterServiceManagerKey' => Adapter::class,
    ],
];
