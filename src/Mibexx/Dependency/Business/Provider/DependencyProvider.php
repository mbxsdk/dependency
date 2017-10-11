<?php

namespace Mibexx\Dependency\Business\Provider;


use Mibexx\Dependency\Business\ContainerInterface;
use Mibexx\Kernel\Business\Locator\Module\AbstractFactory;

interface DependencyProvider
{
    /**
     * @param ContainerInterface $container
     */
    public function defineDependencies(ContainerInterface $container);

    /**
     * @return AbstractFactory
     */
    public function getFactory();

    /**
     * @param AbstractFactory $factory
     */
    public function setFactory(AbstractFactory $factory);
}