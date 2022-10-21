<?php

declare(strict_types=1);

namespace Midnight\PermissionsModule\Service;

use Midnight\Permissions\PermissionService;
use Psr\Container\ContainerInterface;

use function assert;

class PermissionServiceFactory
{
    public function __invoke(ContainerInterface $container): PermissionService
    {
        $permissionContainer = $container->get(PermissionContainer::class);
        assert($permissionContainer instanceof PermissionContainer);
        return new PermissionService($permissionContainer);
    }
}
