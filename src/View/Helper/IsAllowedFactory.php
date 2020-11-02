<?php declare(strict_types=1);

namespace Midnight\PermissionsModule\View\Helper;

use Midnight\Permissions\PermissionServiceInterface;
use Psr\Container\ContainerInterface;

class IsAllowedFactory
{
    public function __invoke(ContainerInterface $container): IsAllowed
    {
        return new IsAllowed($container->get(PermissionServiceInterface::class));
    }
}
