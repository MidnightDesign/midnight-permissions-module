<?php

namespace Midnight\PermissionsModule\View\Helper;

use InvalidArgumentException;
use Midnight\Permissions\PermissionServiceInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;

/**
 * Class IsAllowedFactory
 *
 * @package Midnight\PermissionsModule\View\Helper
 */
class IsAllowedFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return IsAllowed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        if (!$serviceLocator instanceof HelperPluginManager) {
            throw new InvalidArgumentException;
        }
        $sl = $serviceLocator->getServiceLocator();
        return new IsAllowed($this->getPermissionService($sl));
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return PermissionServiceInterface
     */
    private function getPermissionService(ServiceLocatorInterface $serviceLocator)
    {
        return $serviceLocator->get(PermissionServiceInterface::class);
    }
}
