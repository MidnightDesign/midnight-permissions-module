<?php

namespace Midnight\PermissionsModule\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class PermissionContainerFactory
 *
 * @package Midnight\PermissionsModule\Service
 */
class PermissionContainerFactory implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new PermissionContainer($this->getConfig($container));
    }

    /**
     * @param ContainerInterface $container
     * @return ConfigInterface
     */
    private function getConfig(ContainerInterface $container)
    {
        return new Config($container->get('Config')['permissions']);
    }
}
