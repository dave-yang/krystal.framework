<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Application\Module;

/* Responsible for core modules */
final class CoreBag implements CoreBagInterface
{
    /**
     * Critical core module names the framework can not start without
     * 
     * @var array
     */
    private $coreModules = array();

    /**
     * Currently loaded module names
     * 
     * @var array
     */
    private $loadedModules = array();

    /**
     * State initialization
     * 
     * @param array $loadedModules
     * @param array $coreModules
     * @return void
     */
    public function __construct(array $loadedModules, array $coreModules)
    {
        $this->loadedModules = $loadedModules;
        $this->coreModules = $coreModules;
    }

    /**
     * Checks whether a module is loaded
     * 
     * @param string $module Module name
     * @return boolean
     */
    private function isLoadedModule($module)
    {
        return in_array($module, $this->loadedModules);
    }

    /**
     * Returns a collection of missing modules
     * 
     * @return array
     */
    public function getMissingCoreModules()
    {
        $modules = array();

        foreach ($this->coreModules as $module) {
            if (!$this->isLoadedModule($module)) {
                array_push($modules, $module);
            }
        }

        return $modules;
    }

    /**
     * Checks whether all core modules are loaded
     * 
     * @return boolean
     */
    public function hasAllCoreModules()
    {
        $modules = $this->getMissingCoreModules();
        return count($modules) === 0;
    }

    /**
     * Checks whether target module
     * 
     * @param string $module Module name
     * @return boolean
     */
    public function isCoreModule($module)
    {
        return in_array($module, $this->coreModules);
    }
}
