<?php

declare(strict_types=1);

namespace MidnightTest\PermissionsModule\Service;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\ServiceManager;
use Midnight\Permissions\PermissionService;
use Midnight\PermissionsModule\Service\PermissionContainer;
use Midnight\PermissionsModule\Service\PermissionServiceFactory;
use MidnightTest\PermissionsModule\TestDouble\NoPermission;
use MidnightTest\PermissionsModule\TestDouble\YesPermission;
use PHPUnit\Framework\TestCase;

class PermissionServiceFactoryTest extends TestCase
{
    private PermissionServiceFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new PermissionServiceFactory();
    }

    public function testType(): void
    {
        $permissionService = $this->factory->__invoke($this->createContainer());

        self::assertInstanceOf(PermissionService::class, $permissionService);
    }

    public function testGetInstanceFromContainer(): void
    {
        $container = $this->createContainer();

        $service = $container->get(PermissionService::class);

        self::assertInstanceOf(PermissionService::class, $service);
    }

    public function testIsAllowed(): void
    {
        $permissionService = $this->factory->__invoke($this->createContainer());

        self::assertTrue($permissionService->isAllowed(null, YesPermission::class));
        self::assertFalse($permissionService->isAllowed(null, NoPermission::class));
    }

    private function createContainer(): ContainerInterface
    {
        $container = new ServiceManager();
        $permissionContainer = new PermissionContainer(
            $container,
            [
                'factories' => [
                    YesPermission::class => InvokableFactory::class,
                    NoPermission::class => InvokableFactory::class,
                ],
            ]
        );
        $container->setService(PermissionContainer::class, $permissionContainer);
        $container->setFactory(PermissionService::class, PermissionServiceFactory::class);
        return $container;
    }
}
