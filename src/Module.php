<?php

namespace Midnight\PermissionsModule;

use Midnight\Permissions\PermissionServiceInterface;
use Midnight\PermissionsModule\Service\PermissionContainer;
use Midnight\PermissionsModule\Service\PermissionContainerFactory;
use Midnight\PermissionsModule\Service\PermissionServiceFactory;
use Midnight\PermissionsModule\View\Helper\IsAllowedFactory;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

/**
 * Class Module
 *
 * @package Midnight\PermissionsModule
 */
class Module implements ViewHelperProviderInterface, ServiceProviderInterface
{
    /**
     * @return array
     */
    public function getViewHelperConfig()
    {
        return [
            'factories' => [
                'isAllowed' => IsAllowedFactory::class,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                PermissionServiceInterface::class => PermissionServiceFactory::class,
                PermissionContainer::class => PermissionContainerFactory::class,
            ],
        ];
    }
}
