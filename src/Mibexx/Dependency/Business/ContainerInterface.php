<?php

namespace Mibexx\Dependency\Business;

use Mibexx\Kernel\Business\Config\ConfigInterface;
use Mibexx\Kernel\Business\Locator\Locator;

interface ContainerInterface extends \ArrayAccess
{
    /**
     * @return Locator
     */
    public function getLocator();

    /**
     * @param Locator $locator
     */
    public function setLocator(Locator $locator);

    /**
     * @return ConfigInterface
     */
    public function getConfig();

    /**
     * @param ConfigInterface $config
     */
    public function setConfig(ConfigInterface $config);

    /**
     * @param string $name
     * @param callable $callback
     */
    public function setProvidedDependency($name, callable $callback);

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getProvidedDependency($name);
}