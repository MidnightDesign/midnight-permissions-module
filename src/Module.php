<?php declare(strict_types=1);

namespace Midnight\PermissionsModule;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\ServiceProviderInterface;
use Laminas\ModuleManager\Feature\ViewHelperProviderInterface;
use Midnight\Permissions\PermissionServiceInterface;
use Midnight\PermissionsModule\Service\PermissionContainer;
use Midnight\PermissionsModule\Service\PermissionContainerFactory;
use Midnight\PermissionsModule\Service\PermissionServiceFactory;
use Midnight\PermissionsModule\View\Helper\IsAllowedFactory;

class Module
{
    public function getViewHelperConfig(): array
    {
        return [
            'factories' => [
                'isAllowed' => IsAllowedFactory::class,
            ],
        ];
    }

    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                PermissionServiceInterface::class => PermissionServiceFactory::class,
                PermissionContainer::class => PermissionContainerFactory::class,
            ],
        ];
    }

    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
