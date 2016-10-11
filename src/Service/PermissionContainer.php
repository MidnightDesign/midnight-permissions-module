<?php

namespace Midnight\PermissionsModule\Service;

use Midnight\Permissions\PermissionInterface;
use Zend\ServiceManager\AbstractPluginManager;

class PermissionContainer extends AbstractPluginManager
{
    protected $instanceOf = PermissionInterface::class;
}
