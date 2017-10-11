<?php

namespace Mibexx\Dependency\Business\Provider;


use Mibexx\Kernel\Business\Locator\Module\AbstractFactory;

abstract class AbstractDependencyProvider implements DependencyProvider
{
    /**
     * @var AbstractFactory
     */
    private $factory;

    /**
     * @return AbstractFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param AbstractFactory $factory
     */
    public function setFactory(AbstractFactory $factory)
    {
        $this->factory = $factory;
    }


}