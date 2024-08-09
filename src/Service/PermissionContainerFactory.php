<?php

declare(strict_types=1);

namespace Midnight\PermissionsModule\Service;

use Laminas\ServiceManager\AbstractPluginManager;
use Psr\Container\ContainerInterface;

/**
 * @phpstan-import-type ServiceManagerConfiguration from AbstractPluginManager
 */
class PermissionContainerFactory
{
    public function __invoke(ContainerInterface $container): PermissionContainer
    {
        return new PermissionContainer($container, $this->config($container));
    }

    /**
     * @return ServiceManagerConfiguration
     */
    private function config(ContainerInterface $container): array
    {
        /** @var array{permissions: ServiceManagerConfiguration} $config */
        $config = $container->get('config');
        return $config['permissions'];
    }
}
