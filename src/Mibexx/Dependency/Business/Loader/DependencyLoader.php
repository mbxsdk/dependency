<?php

namespace Mibexx\Dependency\Business\Loader;


use Mibexx\Dependency\Business\ContainerInterface;
use Mibexx\Dependency\Business\Provider\AbstractDependencyProvider;
use Mibexx\Dependency\Business\Provider\DependencyProvider;
use Mibexx\Dependency\Exception\ClassNotFound;
use Mibexx\Kernel\Business\Config\ConfigConstants;

class DependencyLoader implements DependencyLoaderInterface
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

    public function loadDependencies()
    {
        foreach ($this->moduleReader->getModuleList() as $module) {
            $this->loadModuleDependencies($module);
        }
    }

    /**
     * @param string $moduleName
     */
    private function loadModuleDependencies($moduleName)
    {
        try {
            $this->getDependencyProvider($moduleName)->defineDependencies($this->container);
        } catch (ClassNotFound $e) {

        }
    }

    /**
     * @return DependencyProvider
     */
    private function getDependencyProvider($moduleName)
    {
        try {
            $dependencyProvider = $this->getProviderClass(
                $moduleName,
                $this->container->getConfig()->get(
                    ConfigConstants::APPLICATION_NAMESPACE
                )
            );
        } catch (ClassNotFound $e) {
            $dependencyProvider = $this->getProviderClass($moduleName);
        }

        return $dependencyProvider;
    }

    /**
     * @param string $moduleName
     * @param string $namespace
     *
     * @return DependencyProvider
     * @throws ClassNotFound
     */
    private function getProviderClass($moduleName, $namespace = 'Mibexx')
    {
        $moduleClassname = '\\' . $namespace . '\\' . $moduleName . '\\' . $moduleName . 'DependencyProvider';

        if (class_exists($moduleClassname, true)) {
            $moduleClass = new $moduleClassname();
            if ($moduleClass instanceof AbstractDependencyProvider) {
                $moduleClass->setFactory($this->container->getLocator()->{$moduleName}()->Factory());
            }

            return $moduleClass;
        }

        throw new ClassNotFound("No dependency provider found in " . $moduleName);
    }


}