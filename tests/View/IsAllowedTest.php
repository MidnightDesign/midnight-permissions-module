<?php

declare(strict_types=1);

namespace MidnightTest\PermissionsModule\View;

use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\ServiceManager;
use Midnight\Permissions\PermissionService;
use Midnight\PermissionsModule\Service\PermissionContainer;
use Midnight\PermissionsModule\View\Helper\IsAllowed;
use MidnightTest\PermissionsModule\TestDouble\NoPermission;
use MidnightTest\PermissionsModule\TestDouble\YesPermission;
use PHPUnit\Framework\TestCase;

class IsAllowedTest extends TestCase
{
    private ServiceManager $container;
    private PermissionService $permissionService;
    private PermissionContainer $permissionContainer;
    private IsAllowed $helper;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new ServiceManager();
        $this->permissionContainer = new PermissionContainer(
            $this->container, [
                                'factories' => [
                                    YesPermission::class => InvokableFactory::class,
                                    NoPermission::class => InvokableFactory::class,
                                ],
                            ]
        );
        $this->permissionService = new PermissionService($this->permissionContainer);
        $this->helper = new IsAllowed($this->permissionService);
    }

    public function testIsAllowed(): void
    {
        self::assertTrue($this->helper->__invoke(null, YesPermission::class));
    }

    public function testIsNotAllowed(): void
    {
        self::assertFalse($this->helper->__invoke(null, NoPermission::class));
    }
}
