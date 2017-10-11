<?php

namespace Mibexx\Dependency;


use Mibexx\Kernel\Business\Locator\Module\AbstractFacade;

/**
 * @method \Mibexx\Dependency\DependencyFactory getFactory()
 */
class DependencyFacade extends AbstractFacade
{

    /**
     * Load all module dependencies
     */
    public function loadDependencies()
    {
        $this->getFactory()->createDependencyLoader()->loadDependencies();
    }

    /**
     * Load all module dependency injections
     */
    public function loadInjections()
    {
        $this->getFactory()->createInjectionLoader()->loadInjections();
    }
}