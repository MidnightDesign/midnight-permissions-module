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
        return new PermissionContainer($this->getConfig($serviceLocator));
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
