<?php declare(strict_types=1);

namespace Midnight\PermissionsModule\Service;

use Psr\Container\ContainerInterface;

class PermissionContainerFactory
{
    /**
     * @return PermissionContainer
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PermissionContainer($container, $container->get('Config')['permissions']);
    }
}
