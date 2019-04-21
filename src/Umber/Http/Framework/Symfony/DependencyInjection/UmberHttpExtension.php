<?php

declare(strict_types=1);

namespace Umber\Http\Framework\Symfony\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Exception;

/**
 * {@inheritdoc}
 */
final class UmberHttpExtension extends Extension
{
    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->loadBundleServiceDefinitions($container);
        $this->loadBundleConfiguration($configs, $container);
    }

    /**
     * Load the bundle service definitions.
     *
     * @throws Exception
     */
    public function loadBundleServiceDefinitions(ContainerBuilder $container): void
    {
        /** @var string $directory */
        $directory = realpath(sprintf('%s/Resources/config', dirname(__DIR__)));

        $loader = new YamlFileLoader($container, new FileLocator($directory));
        $loader->load('services.yaml');
    }

    /**
     * Load the bundle configuration.
     *
     * @param mixed[] $configs
     */
    public function loadBundleConfiguration(array $configs, ContainerBuilder $container): void
    {
        $configuration = new UmberHttpConfiguration();
        $config = $this->processConfiguration($configuration, $configs);

        /** @var string|null $serializer */
        $serializer = $config['serializer'] ?? null;

        if ($serializer === null) {
            return;
        }

        $generator = $container->getDefinition('umber.http.response.generator.json');
        $generator->replaceArgument(1, new Reference($serializer));
    }
}
