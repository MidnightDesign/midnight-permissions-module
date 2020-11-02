<?php declare(strict_types=1);

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
    private $container;
    /** @var PermissionService */
    private $permissionService;
    /** @var PermissionContainer */
    private $permissionContainer;
    /** @var IsAllowed */
    private $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->container = new ServiceManager();
        $this->permissionContainer = new PermissionContainer($this->container, [
            'factories' => [
                YesPermission::class => InvokableFactory::class,
                NoPermission::class => InvokableFactory::class,
            ],
        ]);
        $this->permissionService = new PermissionService($this->permissionContainer);
        $this->helper = new IsAllowed($this->permissionService);
    }

    public function testIsAllowed()
    {
        $this->assertTrue($this->helper->__invoke(null, YesPermission::class));
    }

    public function testIsNotAllowed()
    {
        $this->assertFalse($this->helper->__invoke(null, NoPermission::class));
    }
}
