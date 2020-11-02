<?php declare(strict_types=1);

namespace MidnightTest\PermissionsModule\Service;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Interop\Container\Exception\NotFoundException;
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
    /** @var PermissionServiceFactory */
    private $factory;

    protected function setUp()
    {
        parent::setUp();

        $this->factory = new PermissionServiceFactory();
    }

    public function testType()
    {
        $permissionService = $this->factory->__invoke($this->createContainer());

        $this->assertInstanceOf(PermissionService::class, $permissionService);
    }

    public function testGetInstanceFromContainer()
    {
        $container = $this->createContainer();

        $service = $container->get(PermissionService::class);

        $this->assertInstanceOf(PermissionService::class, $service);
    }

    /**
     * @throws ContainerException
     * @throws NotFoundException
     */
    public function testIsAllowed()
    {
        $permissionService = $this->factory->__invoke($this->createContainer());

        $this->assertTrue($permissionService->isAllowed(null, YesPermission::class));
        $this->assertFalse($permissionService->isAllowed(null, NoPermission::class));
    }

    private function createContainer(): ContainerInterface
    {
        $container = new ServiceManager();
        $permissionContainer = new PermissionContainer(
            $container, [
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
