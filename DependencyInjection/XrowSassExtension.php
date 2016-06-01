<?php

namespace Xrow\SassBundle\DependencyInjection;

use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\SiteAccessAware\ConfigurationProcessor;
use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\SiteAccessAware\ContextualizerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class XrowSassExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $processor = new ConfigurationProcessor( $container, 'xrow_sass', "siteaccess" );
        $processor->mapConfig(
                $config,
                function ( $scopeSettings, $currentScope, ContextualizerInterface $contextualizer )
                {
                    if(isset($scopeSettings['file']))
                    {
                        $contextualizer->setContextualParameter( 'file', $currentScope, $scopeSettings['file'] );
                    }
                }
        );
        $processor->mapConfigArray( 'settings', $config );
    }
}