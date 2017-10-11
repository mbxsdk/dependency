<?php

namespace Mibexx\Dependency\Business\Loader;;


interface DependencyLoaderInterface
{
    /**
     * @param string $moduleName
     */
    public function loadDependencies();
}