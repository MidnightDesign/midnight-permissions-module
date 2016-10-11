<?php declare(strict_types = 1);

namespace MidnightTest\PermissionsModule\TestDouble;

use Midnight\Permissions\PermissionInterface;

class YesPermission implements PermissionInterface
{
    public function isAllowed($user = null, $resource = null)
    {
        return true;
    }
}
