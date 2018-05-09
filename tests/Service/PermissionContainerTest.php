<?php declare(strict_types = 1);

namespace MidnightTest\PermissionsModule\Service;

use Midnight\PermissionsModule\Service\PermissionContainer;
use MidnightTest\PermissionsModule\TestDouble\NoPermission;
use PHPUnit\Framework\TestCase;
use stdClass;
use Zend\ServiceManager\Exception\InvalidServiceException;
use Zend\ServiceManager\ServiceManager;

class PermissionContainerTest extends TestCase
{
    /** @var PermissionContainer */
    private $container;

    protected function setUp()
    {
        parent::setUp();

        $this->container = new PermissionContainer(new ServiceManager(), [
            'invokables' => [
                NoPermission::class,
                stdClass::class,
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
}
