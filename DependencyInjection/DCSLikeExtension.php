<?php

namespace DCS\LikeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class DCSLikeExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        if (!in_array(strtolower($config['db_driver']), array('orm'))) {
            throw new \InvalidArgumentException(sprintf('Invalid db driver "%s".', $config['db_driver']));
        }
        $loader->load(sprintf('%s.xml', $config['db_driver']));

        $container->setParameter('dcs_like.allow_anonymous', $config['allow_anonymous']);

        $container->setParameter('dcs_like.model.thread.class', $config['class']['model']['thread']);
        $container->setParameter('dcs_like.model.like.class', $config['class']['model']['like']);

        $container->setAlias('dcs_like.manager.thread', $config['service']['manager']['thread']);
        $container->setAlias('dcs_like.manager.like', $config['service']['manager']['like']);

        $loader->load('listener.xml');
    }
}
