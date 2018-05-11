<?php declare(strict_types=1);

namespace MidnightTest\PermissionsModule\Service;

use Interop\Container\ContainerInterface;
use Midnight\PermissionsModule\Service\PermissionContainer;
use Midnight\PermissionsModule\Service\PermissionContainerFactory;
use MidnightTest\PermissionsModule\TestDouble\NoPermission;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\ServiceManager\ServiceManager;

class PermissionContainerFactoryTest extends TestCase
{
    /** @var PermissionContainerFactory */
    private $factory;

    protected function setUp()
    {
        parent::setUp();

        $this->factory = new PermissionContainerFactory;
    }

    public function testType()
    {
        $container = $this->factory->__invoke($this->createContainer());

        $this->assertInstanceOf(PermissionContainer::class, $container);
    }

    public function testGetInstanceFromContainer()
    {
        $container = $this->createContainer();

        $service = $container->get(PermissionContainer::class);

        $this->assertInstanceOf(PermissionContainer::class, $service);
    }

    public function testConfigIsInjected()
    {
        $config = [
            'factories' => [
                NoPermission::class => InvokableFactory::class,
            ],
        ];

        $container = $this->factory->__invoke($this->createContainer($config));

        $this->assertInstanceOf(NoPermission::class, $container->get(NoPermission::class));
    }

    private function createContainer(array $permissionsConfig = []): ContainerInterface
    {
        $serviceManager = new ServiceManager;
        $serviceManager->setService('Config', ['permissions' => $permissionsConfig]);
        $serviceManager->setFactory(PermissionContainer::class, PermissionContainerFactory::class);
        return $serviceManager;
    }
}
