<?php declare(strict_types=1);

namespace MidnightTest\PermissionsModule\Service;

use Interop\Container\Exception\ContainerException;
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
    /** @var PermissionContainer */
    private $container;

    protected function setUp()
    {
        parent::setUp();

        $this->container = new PermissionContainer(new ServiceManager(), [
            'factories' => [
                NoPermission::class => InvokableFactory::class,
                stdClass::class => InvokableFactory::class,
            ],
        ]);
    }

    public function testGet()
    {
        $permission = $this->container->get(NoPermission::class);

        $this->assertInstanceOf(NoPermission::class, $permission);
    }

    public function testInvalidPermission()
    {
        $this->expectException(InvalidServiceException::class);

        $this->container->get(stdClass::class);
    }

    /**
     * @throws ContainerException
     */
    public function testServiceManagerV2Validation()
    {
        $permission = new YesPermission();
        $void = $this->container->validatePlugin($permission);
        $this->assertNull($void);
    }

    /**
     * @throws ContainerException
     */
    public function testServiceManagerV3Validation()
    {
        $permission = new YesPermission();
        $void = $this->container->validate($permission);
        $this->assertNull($void);
    }
}
