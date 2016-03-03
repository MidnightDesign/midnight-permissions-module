<?php

namespace Midnight\PermissionsModule\Service;

use Midnight\Permissions\PermissionInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;

class PermissionContainer extends AbstractPluginManager
{
    protected $instanceOf = PermissionInterface::class;
}
