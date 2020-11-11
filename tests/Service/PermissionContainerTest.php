<?php

declare(strict_types=1);

namespace MidnightTest\PermissionsModule\Service;

use Laminas\ServiceManager\Exception\InvalidServiceException;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\ServiceManager;
use Midnight\PermissionsModule\Service\PermissionContainer;
use MidnightTest\PermissionsModule\TestDouble\NoPermission;
use MidnightTest\PermissionsModule\TestDouble\YesPermission;
use PHPUnit\Framework\TestCase;
use stdClass;

class PermissionContainerTest extends TestCase
{
    private PermissionContainer $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new PermissionContainer(
            new ServiceManager(),
            [
                'factories' => [
                    NoPermission::class => InvokableFactory::class,
                    stdClass::class => InvokableFactory::class,
                ],
            ]
        );
    }

    public function testGet(): void
    {
        $permission = $this->container->get(NoPermission::class);

        self::assertInstanceOf(NoPermission::class, $permission);
    }

    public function testInvalidPermission(): void
    {
        $this->expectException(InvalidServiceException::class);

        $this->container->get(stdClass::class);
    }

    public function testServiceManagerValidation(): void
    {
        $permission = new YesPermission();
        $this->container->validate($permission);
        // smoke test
        self::assertSame(1 + 1, 2);
    }
}
