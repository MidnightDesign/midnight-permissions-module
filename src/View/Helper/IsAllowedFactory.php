<?php

namespace Midnight\PermissionsModule\View\Helper;

use Interop\Container\ContainerInterface;
use Midnight\Permissions\PermissionServiceInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class IsAllowedFactory
 *
 * @package Midnight\PermissionsModule\View\Helper
 */
class IsAllowedFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new IsAllowed($this->getPermissionService($container));
    }

    /**
     * @param ContainerInterface $container
     * @return PermissionServiceInterface
     */
    private function getPermissionService(ContainerInterface $container)
    {
        return $container->get(PermissionServiceInterface::class);
    }
}
