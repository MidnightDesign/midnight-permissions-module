<?php

namespace Midnight\PermissionsModule\Service;

use Midnight\Permissions\PermissionService;
use Midnight\Permissions\PermissionServiceInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PermissionServiceFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return PermissionServiceInterface
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new PermissionService($this->getPermissionContainer($serviceLocator));
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return PermissionContainer
     */
    private function getPermissionContainer(ServiceLocatorInterface $serviceLocator)
    {
        return $serviceLocator->get(PermissionContainer::class);
    }
}
