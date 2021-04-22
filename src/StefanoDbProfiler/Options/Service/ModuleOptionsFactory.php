<?php
namespace StefanoDbProfiler\Options\Service;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use StefanoDbProfiler\Options\ModuleOptions;

class ModuleOptionsFactory
    implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return ModuleOptions
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : ModuleOptions
    {
        $config = $container->get('Config');
        return new ModuleOptions($config['stefano_db_profiler'] ?? []);
    }
}