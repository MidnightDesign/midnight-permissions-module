<?php declare(strict_types=1);

namespace Midnight\PermissionsModule\Service;

use Midnight\Permissions\PermissionInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;

class PermissionContainer extends AbstractPluginManager
{
    public function validate($plugin)
    {
        if (!$plugin instanceof PermissionInterface) {
            throw new InvalidServiceException(sprintf(
                'Invalid permission. Expected an instance of %s, got %s.',
                PermissionInterface::class,
                is_object($plugin) ? get_class($plugin) : gettype($plugin)
            ));
        }
    }

    /**
     * needed for ServiceManager v2 compatibility
     *
     * @throws \Interop\Container\Exception\ContainerException
     * @codeCoverageIgnore
     */
    public function validatePlugin($plugin)
    {
        $this->validate($plugin);
    }
}
