<?php
namespace StfnLaminasDbProfiler;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\DependencyIndicatorInterface;

class Module
    implements ConfigProviderInterface,
               DependencyIndicatorInterface
{
    public function getConfig() {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getModuleDependencies() {
        return [
            'Laminas\\DeveloperTools'
        ];
    }
}