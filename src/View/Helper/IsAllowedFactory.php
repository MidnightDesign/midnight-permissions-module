<?php declare(strict_types=1);

namespace Midnight\PermissionsModule\View\Helper;

use Midnight\Permissions\PermissionServiceInterface;
use Psr\Container\ContainerInterface;
use Zend\ServiceManager\AbstractPluginManager;

class IsAllowedFactory
{
    public function __invoke(ContainerInterface $container): IsAllowed
    {
        if ($container instanceof AbstractPluginManager) {
            return $this($container->getServiceLocator()); // @codeCoverageIgnore
        }

        return new IsAllowed($container->get(PermissionServiceInterface::class));
    }
}
