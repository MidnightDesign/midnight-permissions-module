<?php

namespace Midnight\PermissionsModule\Service;

use Interop\Container\ContainerInterface;
use Midnight\Permissions\PermissionService;
use Zend\ServiceManager\Factory\FactoryInterface;

class PermissionServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PermissionService($container->get(PermissionContainer::class));
    }
}
