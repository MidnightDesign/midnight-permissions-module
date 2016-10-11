<?php declare(strict_types = 1);

namespace MidnightTest\PermissionsModule\View;

use Interop\Container\ContainerInterface;
use Midnight\Permissions\PermissionServiceInterface;
use Midnight\PermissionsModule\View\Helper\IsAllowed;
use Midnight\PermissionsModule\View\Helper\IsAllowedFactory;
use MidnightTest\PermissionsModule\TestDouble\YesPermission;
use PHPUnit_Framework_TestCase;
use Prophecy\Argument;
use Zend\ServiceManager\ServiceManager;

class IsAllowedFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var IsAllowedFactory */
    private $factory;

    protected function setUp()
    {
        parent::setUp();

        $this->factory = new IsAllowedFactory;
    }

    public function testType()
    {
        $helper = $this->factory->__invoke($this->createContainer(), IsAllowed::class);

        $this->assertInstanceOf(IsAllowed::class, $helper);
    }

    public function testPermissionServiceIsInjected()
    {
        $helper = $this->factory->__invoke($this->createContainer(), IsAllowed::class);

        $this->assertTrue($helper->__invoke(null, YesPermission::class));
    }

    private function createContainer():ContainerInterface
    {
        $container = new ServiceManager;
        $permissionServiceProphecy = $this->prophesize(PermissionServiceInterface::class);
        $permissionServiceProphecy
            ->isAllowed(Argument::any(), Argument::any(), Argument::any())
            ->willReturn(true);
        $container->setService(PermissionServiceInterface::class, $permissionServiceProphecy->reveal());
        return $container;
    }
}
