<?php declare(strict_types=1);

namespace Midnight\PermissionsModule\Service;

use Psr\Container\ContainerInterface;

class PermissionContainerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): PermissionContainer
    {
        \assert($container instanceof \Interop\Container\ContainerInterface);
        return new PermissionContainer($container, $container->get('Config')['permissions']);
    }
}
