<?php declare(strict_types = 1);

namespace MidnightTest\PermissionsModule;

use Midnight\Permissions\PermissionServiceInterface;
use Midnight\PermissionsModule\Module;
use Midnight\PermissionsModule\Service\PermissionContainer;
use Midnight\PermissionsModule\Service\PermissionContainerFactory;
use Midnight\PermissionsModule\Service\PermissionServiceFactory;
use Midnight\PermissionsModule\View\Helper\IsAllowedFactory;
use PHPUnit_Framework_TestCase;

class ModuleTest extends PHPUnit_Framework_TestCase
{
    /** @var Module */
    private $module;

    protected function setUp()
    {
        parent::setUp();

        $this->module = new Module;
    }

    public function testViewHelperConfig()
    {
        $expected = [
            'factories' => ['isAllowed' => IsAllowedFactory::class],
        ];

        $this->assertEquals($expected, $this->module->getViewHelperConfig());
    }

    public function testServiceConfig()
    {
        $expected = [
            'factories' => [
                PermissionServiceInterface::class => PermissionServiceFactory::class,
                PermissionContainer::class => PermissionContainerFactory::class,
            ],
        ];

        $this->assertEquals($expected, $this->module->getServiceConfig());
    }

    public function testConfig()
    {
        $expected = [
            'permissions' => [],
        ];

        $this->assertEquals($expected, $this->module->getConfig());
    }
}
