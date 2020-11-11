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

class PermissionContainer extends AbstractPluginManager
{
    /**
     * @param object $plugin
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function validate($plugin): void
    {
        if (!$plugin instanceof PermissionInterface) {
            throw new InvalidServiceException(
                sprintf(
                    'Invalid permission. Expected an instance of %s, got %s.',
                    PermissionInterface::class,
                    // @phpstan-ignore-next-line
                    is_object($plugin) ? get_class($plugin) : gettype($plugin)
                )
            );
        }
    }
}
