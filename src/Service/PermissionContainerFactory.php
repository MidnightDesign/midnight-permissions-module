<?php

namespace Midnight\PermissionsModule\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class PermissionContainerFactory implements FactoryInterface
{
    /**
     * @return PermissionContainer
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PermissionContainer($container, $container->get('Config')['permissions']);
    }
}
