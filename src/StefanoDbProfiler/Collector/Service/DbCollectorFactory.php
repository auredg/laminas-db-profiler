<?php
namespace StefanoDbProfiler\Collector\Service;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use StefanoDbProfiler\Collector\DbCollector;
use StefanoDbProfiler\Options\ModuleOptions;

class DbCollectorFactory
    implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return DbCollector
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : DbCollector
    {
        $moduleOptions = $this->getModuleOptions($container);

        $dbCollector = new DbCollector();

        foreach($moduleOptions->getDbAdapterServiceManagerKey() as $adapterServiceKey) {
            if($container->has($adapterServiceKey)) {
                $profiler = $container->get($adapterServiceKey)
                                           ->getProfiler();
                if(null != $profiler) {
                    $dbCollector->addProfiler($adapterServiceKey, $profiler);
                }
            }
        }

        return $dbCollector;
    }

    /**
     * @param ContainerInterface $container
     * @return ModuleOptions
     */
    private function getModuleOptions(ContainerInterface $container) : ModuleOptions
    {
        return $container->get('StefanoDbProfiler\Options\ModuleOptions');
    }
}
