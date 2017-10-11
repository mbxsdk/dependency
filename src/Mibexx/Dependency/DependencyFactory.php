<?php

namespace Mibexx\Dependency;


use Mibexx\Dependency\Business\Loader\DependencyLoader;
use Mibexx\Dependency\Business\Loader\InjectionLoader;
use Mibexx\Dependency\Business\Loader\ModuleReader;
use Mibexx\Kernel\Business\Locator\Module\AbstractFactory;

class DependencyFactory extends AbstractFactory
{
    /**
     * @return DependencyLoader
     */
    public function createDependencyLoader()
    {
        return new DependencyLoader(
            $this->getContainer(),
            $this->createModuleReader()
        );
    }

    /**
     * @return InjectionLoader
     */
    public function createInjectionLoader()
    {
        return new InjectionLoader(
            $this->getContainer(),
            $this->createModuleReader()
        );
    }

    /**
     * @return ModuleReader
     */
    public function createModuleReader()
    {
        return new ModuleReader($this->getConfig());
    }
}