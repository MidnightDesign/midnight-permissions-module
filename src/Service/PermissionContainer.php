<?php declare(strict_types=1);

namespace Midnight\PermissionsModule\Service;

use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\Exception\InvalidServiceException;
use Midnight\Permissions\PermissionInterface;

class PermissionContainer extends AbstractPluginManager
{
    public function validate($plugin)
    {
        if (!$plugin instanceof PermissionInterface) {
            throw new InvalidServiceException(
                sprintf(
                    'Invalid permission. Expected an instance of %s, got %s.',
                    PermissionInterface::class,
                    is_object($plugin) ? get_class($plugin) : gettype($plugin)
                ));
        }
    }

    /**
     * needed for ServiceManager v2 compatibility
     *
     * @throws ContainerException
     */
    public function validatePlugin($plugin)
    {
        $this->validate($plugin); // @codeCoverageIgnore
    }
}
