<?php
namespace StefanoDbProfiler;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\AutoloaderProviderInterface;
use Laminas\ModuleManager\Feature\DependencyIndicatorInterface;

class Module
    implements ConfigProviderInterface,
               AutoloaderProviderInterface,
               DependencyIndicatorInterface
{
    public function getConfig() {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return [
            'Laminas\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }

    public function getModuleDependencies() {
        return [
            'Laminas\\DeveloperTools'
        ];
    }
}