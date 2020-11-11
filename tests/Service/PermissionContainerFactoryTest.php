<?php

declare(strict_types=1);

namespace MidnightTest\PermissionsModule\Service;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\ServiceManager;
use Midnight\PermissionsModule\Service\PermissionContainer;
use Midnight\PermissionsModule\Service\PermissionContainerFactory;
use MidnightTest\PermissionsModule\TestDouble\NoPermission;
use PHPUnit\Framework\TestCase;

class PermissionContainerFactoryTest extends TestCase
{
    private PermissionContainerFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new PermissionContainerFactory();
    }

    public function testType(): void
    {
        $container = $this->factory->__invoke($this->createContainer());

        self::assertInstanceOf(PermissionContainer::class, $container);
    }

    public function testGetInstanceFromContainer(): void
    {
        $container = $this->createContainer();

        $service = $container->get(PermissionContainer::class);

        self::assertInstanceOf(PermissionContainer::class, $service);
    }

    public function testConfigIsInjected(): void
    {
        $config = [
            'factories' => [
                NoPermission::class => InvokableFactory::class,
            ],
        ];

        $container = $this->factory->__invoke($this->createContainer($config));

        self::assertInstanceOf(NoPermission::class, $container->get(NoPermission::class));
    }

    /**
     * @param array<string, mixed> $permissionsConfig
     */
    private function createContainer(array $permissionsConfig = []): ContainerInterface
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('Config', ['permissions' => $permissionsConfig]);
        $serviceManager->setFactory(PermissionContainer::class, PermissionContainerFactory::class);
        return $serviceManager;
    }
}
