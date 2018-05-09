<?php declare(strict_types=1);

namespace Midnight\PermissionsModule\View\Helper;

use Midnight\Permissions\PermissionServiceInterface;
use Psr\Container\ContainerInterface;

class IsAllowedFactory
{
    /**
     * @return IsAllowed
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new IsAllowed($container->get(PermissionServiceInterface::class));
    }
}
