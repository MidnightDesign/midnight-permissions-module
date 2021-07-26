<?php

declare(strict_types=1);

namespace MidnightTest\PermissionsModule\TestDouble;

use Midnight\Permissions\PermissionInterface;

class YesPermission implements PermissionInterface
{
    /**
     * @phpstan-param mixed|null $user
     * @phpstan-param mixed|null $resource
     */
    public function isAllowed($user = null, $resource = null): bool
    {
        return true;
    }
}
