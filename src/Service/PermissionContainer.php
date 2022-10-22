<?php

declare(strict_types=1);

namespace Midnight\PermissionsModule\Service;

use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\Exception\InvalidServiceException;
use Midnight\Permissions\PermissionInterface;

use function get_class;
use function gettype;
use function is_object;
use function sprintf;

/**
 * @extends AbstractPluginManager<PermissionInterface>
 */
class PermissionContainer extends AbstractPluginManager
{
    /**
     * @param mixed $plugin
     */
    public function validate($plugin): void
    {
        if (!$plugin instanceof PermissionInterface) {
            throw new InvalidServiceException(
                sprintf(
                    'Invalid permission. Expected an instance of %s, got %s.',
                    PermissionInterface::class,
                    is_object($plugin) ? get_class($plugin) : gettype($plugin)
                )
            );
        }
    }
}
