<?php

namespace Mibexx\Dependency\Business\Loader;


use Mibexx\Kernel\Business\Config\ConfigConstants;
use Mibexx\Kernel\Business\Config\ConfigInterface;

class ModuleReader
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * ModuleReader constructor.
     *
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getModuleList()
    {
        $modules = [];

        $modules = array_merge(
            $modules,
            $this->getModuleFromPath($this->getApplicationPath() . '/vendor/mbxsdk/*/src'),
            $this->getModuleFromPath($this->getApplicationPath() . '/src/Mibexx'),
            $this->getModuleFromPath($this->getApplicationPath() . '/src/' . $this->getApplicationNamespace())
        );

        return array_unique($modules);
    }

    /**
     * @param string $path
     * @param string $namespace
     *
     * @return array
     */
    private function getModuleFromPath($path)
    {
        $modules = [];
        foreach (glob($path . '/*') as $modulePath) {
            $modules[] = basename($modulePath);
        }
        return $modules;
    }

    /**
     * @return string
     */
    private function getApplicationNamespace()
    {
        return $this->config->get(ConfigConstants::APPLICATION_NAMESPACE);
    }

    /**
     * @return string
     */
    private function getApplicationPath()
    {
        return $this->config->get(ConfigConstants::APPLICATION_PATH);
    }


}