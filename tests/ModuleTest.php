<?php

declare(strict_types=1);

namespace MidnightTest\PermissionsModule;

use Midnight\Permissions\PermissionServiceInterface;
use Midnight\PermissionsModule\Module;
use Midnight\PermissionsModule\Service\PermissionContainer;
use Midnight\PermissionsModule\Service\PermissionContainerFactory;
use Midnight\PermissionsModule\Service\PermissionServiceFactory;
use Midnight\PermissionsModule\View\Helper\IsAllowedFactory;
use PHPUnit\Framework\TestCase;

class ModuleTest extends TestCase
{
    private Module $module;

    protected function setUp(): void
    {
        parent::setUp();

        $this->module = new Module();
    }

    public function testViewHelperConfig(): void
    {
        $expected = [
            'factories' => ['isAllowed' => IsAllowedFactory::class],
        ];

        self::assertEquals($expected, $this->module->getViewHelperConfig());
    }

    public function testServiceConfig(): void
    {
        $expected = [
            'factories' => [
                PermissionServiceInterface::class => PermissionServiceFactory::class,
                PermissionContainer::class => PermissionContainerFactory::class,
            ],
        ];

        self::assertEquals($expected, $this->module->getServiceConfig());
    }

    public function testConfig(): void
    {
        $expected = [
            'permissions' => [],
        ];

        self::assertEquals($expected, $this->module->getConfig());
    }
}
