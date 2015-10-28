<?php

namespace Midnight\PermissionsModule\View\Helper;

use Midnight\Permissions\PermissionServiceInterface;
use Zend\View\Helper\AbstractHelper;

/**
 * Class IsAllowed
 *
 * @package Midnight\PermissionsModule\View\Helper
 */
class IsAllowed extends AbstractHelper
{
    /** @var PermissionServiceInterface */
    private $permissionService;

    /**
     * IsAllowed constructor.
     *
     * @param PermissionServiceInterface $permissionService
     */
    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * @param mixed|null $user
     * @param string     $permission
     * @param mixed|null $resource
     */
    public function __invoke($user = null, $permission, $resource = null)
    {
        return $this->permissionService->isAllowed($user = null, $permission, $resource = null);
    }
}
