<?php

declare(strict_types=1);

namespace Midnight\PermissionsModule\View\Helper;

use Midnight\Permissions\PermissionServiceInterface;

class IsAllowed
{
    private PermissionServiceInterface $permissionService;

    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * @param mixed|null $user
     * @param mixed|null $resource
     * @phpcs:disable PEAR.Functions.ValidDefaultValue.NotAtEnd
     */
    public function __invoke($user = null, string $permission, $resource = null): bool
    {
        return $this->permissionService->isAllowed($user, $permission, $resource);
    }
}
