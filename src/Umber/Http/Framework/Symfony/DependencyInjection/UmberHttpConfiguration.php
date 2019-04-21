<?php

declare(strict_types=1);

namespace Umber\Http\Framework\Symfony\DependencyInjection;

use Umber\Http\Serializer\HttpResponseSerializerInterface;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * {@inheritdoc}
 */
final class UmberHttpConfiguration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $tree = new TreeBuilder('umber_http');

        /** @var ArrayNodeDefinition $root */
        $root = $tree->getRootNode();

        $root->children()
            ->scalarNode('serializer')
                ->info(sprintf('Provide a service name that implements %s', HttpResponseSerializerInterface::class))
                ->defaultNull();

        return $tree;
    }
}
