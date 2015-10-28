<?php

namespace Midnight\PermissionsModule\Service;

use Midnight\Permissions\PermissionInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;

class PermissionContainer extends AbstractPluginManager
{
    /**
     * Validate the plugin
     *
     * Checks that the filter loaded is either a valid callback or an instance
     * of FilterInterface.
     *
     * @param  mixed $plugin
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if (!$plugin instanceof PermissionInterface) {
            throw new Exception\RuntimeException(sprintf(
                'Invalid permission. Expected an instance of %s, got %s.',
                PermissionInterface::class,
                is_object($plugin) ? get_class($plugin) : gettype($plugin)
            ));
        }
    }
}
