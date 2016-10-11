<?php

namespace Midnight\PermissionsModule\View\Helper;

use Interop\Container\ContainerInterface;
use Midnight\Permissions\PermissionServiceInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class IsAllowedFactory implements FactoryInterface
{
    /**
     * @return IsAllowed
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new IsAllowed($container->get(PermissionServiceInterface::class));
    }
}
