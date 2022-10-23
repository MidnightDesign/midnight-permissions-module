<?php

declare(strict_types=1);

namespace Midnight\PermissionsModule\Service;

use Psr\Container\ContainerInterface;

class PermissionContainerFactory
{
    public function __invoke(ContainerInterface $container): PermissionContainer
    {
        return new PermissionContainer($container, $this->config($container));
    }

    /**
     * @return array<string, mixed>
     */
    private function config(ContainerInterface $container): array
    {
        /** @var array<string, array<string, mixed>> $config */
        $config = $container->get('config');
        return $config['permissions'];
    }
}
