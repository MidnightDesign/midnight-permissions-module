<?php

namespace Midnight\PermissionsModule\Service;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PermissionContainerFactory
 *
 * @package Midnight\PermissionsModule\Service
 */
class PermissionContainerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return PermissionContainer
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $permissionContainer = new PermissionContainer($this->getConfig($serviceLocator));
        $permissionContainer->setServiceLocator($serviceLocator);
        return $permissionContainer;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return ConfigInterface
     */
    private function getConfig(ServiceLocatorInterface $serviceLocator)
    {
        return new Config($serviceLocator->get('Config')['permissions']);
    }
}
