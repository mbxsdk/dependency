<?php

namespace Mibexx\Dependency\Business\Loader;


use Mibexx\Dependency\Business\ContainerInterface;
use Mibexx\Dependency\Business\Provider\AbstractInjectionProvider;
use Mibexx\Dependency\Business\Provider\InjectionProvider;
use Mibexx\Kernel\Business\Config\ConfigConstants;

class InjectionLoader implements InjectionLoaderInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var ModuleReader
     */
    private $moduleReader;

    /**
     * Loader constructor.
     *
     * @param ContainerInterface $container
     * @param ModuleReader $moduleReader
     */
    public function __construct(ContainerInterface $container, ModuleReader $moduleReader)
    {
        $this->container = $container;
        $this->moduleReader = $moduleReader;
    }

    public function loadInjections()
    {
        foreach ($this->moduleReader->getModuleList() as $module) {
            $this->loadModuleDependencyInjections($module);
        }
    }

    /**
     * @param string $moduleName
     */
    private function loadModuleDependencyInjections($moduleName)
    {
        foreach ($this->getInjectionProviders($moduleName) as $provider) {
            if ($provider instanceof InjectionProvider) {
                $provider->injectDependency($this->container);
            }
        }
    }

    /**
     * @return array
     */
    private function getInjectionProviders($moduleName)
    {
        $injectionProvider = [];

        $injectionProvider[] = $this->getInjectionProvider($moduleName);
        $injectionProvider[] = $this->getInjectionProvider(
            $moduleName,
            $this->container->getConfig()->get(
                ConfigConstants::APPLICATION_NAMESPACE
            )
        );

        return $injectionProvider;
    }

    /**
     * @param string $moduleName
     * @param string $suffix
     * @param string $namespace
     *
     * @return null
     */
    private function getInjectionProvider($moduleName, $namespace = 'Mibexx')
    {
        $moduleClass = null;
        $moduleClassname = '\\' . $namespace . '\\' . $moduleName . '\\Dependency\\' . $moduleName . 'InjectionProvider';
        if (class_exists($moduleClassname)) {
            $moduleClass = new $moduleClassname();
            if ($moduleClass instanceof AbstractInjectionProvider) {
                $moduleClass->setFactory($this->container->getLocator()->{$moduleName}()->Factory());
            }
        }
        return $moduleClass;
    }


}