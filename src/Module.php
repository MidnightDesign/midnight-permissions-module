<?php

declare(strict_types=1);

namespace Midnight\PermissionsModule;

use Midnight\Permissions\PermissionServiceInterface;
use Midnight\PermissionsModule\Service\PermissionContainer;
use Midnight\PermissionsModule\Service\PermissionContainerFactory;
use Midnight\PermissionsModule\Service\PermissionServiceFactory;
use Midnight\PermissionsModule\View\Helper\IsAllowedFactory;

class Module
{
    /**
     * @return array<string, array<string, string>>
     */
    public function getViewHelperConfig(): array
    {
        return [
            'factories' => [
                'isAllowed' => IsAllowedFactory::class,
            ],
        ];
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                PermissionServiceInterface::class => PermissionServiceFactory::class,
                PermissionContainer::class => PermissionContainerFactory::class,
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
