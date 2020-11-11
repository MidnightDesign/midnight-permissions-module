<?php

declare(strict_types=1);

namespace MidnightTest\PermissionsModule\View;

use Laminas\ServiceManager\ServiceManager;
use Midnight\Permissions\PermissionServiceInterface;
use Midnight\Permissions\PermissionServiceStub;
use Midnight\PermissionsModule\View\Helper\IsAllowed;
use Midnight\PermissionsModule\View\Helper\IsAllowedFactory;
use MidnightTest\PermissionsModule\TestDouble\YesPermission;
use PHPUnit\Framework\TestCase;

class IsAllowedFactoryTest extends TestCase
{
    private IsAllowedFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new IsAllowedFactory();
    }

    public function testGetInstanceFromContainer(): void
    {
        $container = $this->createContainer();
        $container->setFactory(IsAllowed::class, IsAllowedFactory::class);

        $service = $container->get(IsAllowed::class);

        self::assertInstanceOf(IsAllowed::class, $service);
    }

    public function testType(): void
    {
        $helper = $this->factory->__invoke($this->createContainer());

        self::assertInstanceOf(IsAllowed::class, $helper);
    }

    public function testPermissionServiceIsInjected(): void
    {
        $helper = $this->factory->__invoke($this->createContainer());

        self::assertTrue($helper->__invoke(null, YesPermission::class));
    }

    private function createContainer(): ServiceManager
    {
        $container = new ServiceManager();
        $service = new PermissionServiceStub();
        $container->setService(PermissionServiceInterface::class, $service);
        return $container;
    }
}
