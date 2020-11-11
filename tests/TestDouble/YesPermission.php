<?php

declare(strict_types=1);

namespace MidnightTest\PermissionsModule\TestDouble;

use Midnight\Permissions\PermissionInterface;

class YesPermission implements PermissionInterface
{
    /**
     * @param mixed|null $user
     * @param mixed|null $resource
     */
    public function isAllowed($user = null, $resource = null): bool
    {
        return true;
    }
}
