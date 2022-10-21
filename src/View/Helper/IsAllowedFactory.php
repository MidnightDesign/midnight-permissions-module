<?php

declare(strict_types=1);

namespace Midnight\PermissionsModule\View\Helper;

use Midnight\Permissions\PermissionServiceInterface;
use Psr\Container\ContainerInterface;

use function assert;

class IsAllowedFactory
{
    public function __invoke(ContainerInterface $container): IsAllowed
    {
        $service = $container->get(PermissionServiceInterface::class);
        assert($service instanceof PermissionServiceInterface);
        return new IsAllowed($service);
    }
}
