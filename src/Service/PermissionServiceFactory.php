<?php

namespace Midnight\PermissionsModule\Service;

use Interop\Container\ContainerInterface;
use Midnight\Permissions\PermissionService;
use Zend\ServiceManager\Factory\FactoryInterface;

class PermissionServiceFactory implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PermissionService($this->getPermissionContainer($container));
    }

    /**
     * @param ContainerInterface $container
     * @return PermissionContainer
     */
    private function getPermissionContainer(ContainerInterface $container)
    {
        return $container->get(PermissionContainer::class);
    }
}
