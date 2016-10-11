<?php

namespace Midnight\PermissionsModule;

use Midnight\Permissions\PermissionServiceInterface;
use Midnight\PermissionsModule\Service\PermissionContainer;
use Midnight\PermissionsModule\Service\PermissionContainerFactory;
use Midnight\PermissionsModule\Service\PermissionServiceFactory;
use Midnight\PermissionsModule\View\Helper\IsAllowedFactory;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ViewHelperProviderInterface, ServiceProviderInterface, ConfigProviderInterface
{
    public function getViewHelperConfig():array
    {
        return [
            'factories' => [
                'isAllowed' => IsAllowedFactory::class,
            ],
        ];
    }

    public function getServiceConfig():array
    {
        return [
            'factories' => [
                PermissionServiceInterface::class => PermissionServiceFactory::class,
                PermissionContainer::class => PermissionContainerFactory::class,
            ],
        ];
    }

    public function getConfig():array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
