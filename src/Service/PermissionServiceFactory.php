<?php

declare(strict_types=1);

namespace Midnight\PermissionsModule\Service;

use Midnight\Permissions\PermissionService;
use Psr\Container\ContainerInterface;

class PermissionServiceFactory
{
    public function __invoke(ContainerInterface $container): PermissionService
    {
        return new PermissionService($container->get(PermissionContainer::class));
    }
}
