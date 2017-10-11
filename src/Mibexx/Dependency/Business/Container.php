<?php

namespace Mibexx\Dependency\Business;



use Mibexx\Kernel\Business\Config\ConfigInterface;
use Mibexx\Kernel\Business\Locator\Locator;

class Container extends \Pimple\Container implements ContainerInterface
{
    /**
     * @var Locator
     */
    private $locator;

    /**
     * @return Locator
     */
    public function getLocator()
    {
        return $this->locator;
    }

    /**
     * @param Locator $locator
     */
    public function setLocator(Locator $locator)
    {
        $this->locator = $locator;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig()
    {
        return $this['config'];
    }

    /**
     * @param ConfigInterface $config
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->setProvidedDependency('config', function() use ($config) {
            return $config;
        });
    }

    /**
     * @param string $name
     * @param callable $callback
     */
    public function setProvidedDependency($name, callable $callback)
    {
        $this[$name] = $callback;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getProvidedDependency($name)
    {
        return $this[$name];
    }
}