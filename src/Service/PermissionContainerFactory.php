<?php

declare(strict_types=1);

namespace Midnight\PermissionsModule\Service;

use Psr\Container\ContainerInterface;

use function assert;

class PermissionContainerFactory
{
    public function __invoke(ContainerInterface $container): PermissionContainer
    {
        assert($container instanceof \Interop\Container\ContainerInterface);
        return new PermissionContainer($container, $container->get('Config')['permissions']);
    }
}
