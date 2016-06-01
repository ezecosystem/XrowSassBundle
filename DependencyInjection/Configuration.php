<?php

namespace Xrow\SassBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\SiteAccessAware\Configuration as SiteAccessConfiguration;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

class Configuration extends SiteAccessConfiguration implements ConfigurationInterface 
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root( 'xrow_sass' );

        $systemNode = $this->generateScopeBaseNode( $rootNode, "siteaccess" );
        $systemNode
            ->scalarNode( 'file' )->end()
            ->variableNode( 'settings' )
        ->end();

        return $treeBuilder;
    }
}