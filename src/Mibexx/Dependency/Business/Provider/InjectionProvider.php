<?php

namespace Mibexx\Dependency\Business\Provider;


use Mibexx\Dependency\Business\ContainerInterface;
use Mibexx\Kernel\Business\Locator\Module\AbstractFactory;

interface InjectionProvider
{
    /**
     * @param ContainerInterface $container
     */
    public function injectDependency(ContainerInterface $container);

    /**
     * @return AbstractFactory
     */
    public function getFactory();

    /**
     * @param AbstractFactory $factory
     */
    public function setFactory(AbstractFactory $factory);
}