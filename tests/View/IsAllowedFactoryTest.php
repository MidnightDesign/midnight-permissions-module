<?php declare(strict_types=1);

namespace MidnightTest\PermissionsModule\View;

use Laminas\ServiceManager\ServiceManager;
use Laminas\View\HelperPluginManager;
use Midnight\Permissions\PermissionServiceInterface;
use Midnight\PermissionsModule\View\Helper\IsAllowed;
use Midnight\PermissionsModule\View\Helper\IsAllowedFactory;
use MidnightTest\PermissionsModule\TestDouble\YesPermission;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class IsAllowedFactoryTest extends TestCase
{
    /** @var IsAllowedFactory */
    private $factory;

    protected function setUp()
    {
        parent::setUp();

        $this->factory = new IsAllowedFactory();
    }

    public function testGetInstanceFromContainer()
    {
        $container = $this->createContainer();
        $container->setFactory(IsAllowed::class, IsAllowedFactory::class);

        $service = $container->get(IsAllowed::class);

        $this->assertInstanceOf(IsAllowed::class, $service);
    }

    public function testInstanceCanBePulledFromHelperPluginManager()
    {
        $helperManager = $this->createHelperPluginManager();

        $plugin = $helperManager->get(IsAllowed::class);

        $this->assertInstanceOf(IsAllowed::class, $plugin);
    }

    public function testType()
    {
        $helper = $this->factory->__invoke($this->createContainer());

        $this->assertInstanceOf(IsAllowed::class, $helper);
    }

    public function testPermissionServiceIsInjected()
    {
        $helper = $this->factory->__invoke($this->createContainer());

        $this->assertTrue($helper->__invoke(null, YesPermission::class));
    }

    private function createContainer(): ServiceManager
    {
        $container = new ServiceManager();
        $permissionServiceProphecy = $this->prophesize(PermissionServiceInterface::class);
        $permissionServiceProphecy
            ->isAllowed(Argument::any(), Argument::any(), Argument::any())
            ->willReturn(true);
        $container->setService(PermissionServiceInterface::class, $permissionServiceProphecy->reveal());
        return $container;
    }

    private function createHelperPluginManager(): HelperPluginManager
    {
        $sm = $this->createContainer();
        $pluginManager = new HelperPluginManager($sm);
        $pluginManager->setFactory(IsAllowed::class, IsAllowedFactory::class);
        return $pluginManager;
    }
}
