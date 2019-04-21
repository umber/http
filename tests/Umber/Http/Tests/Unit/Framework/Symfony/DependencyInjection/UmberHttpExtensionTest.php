<?php

namespace Umber\Http\Tests\Unit\Framework\Symfony\DependencyInjection;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Umber\Http\Framework\Symfony\DependencyInjection\UmberHttpExtension;

/**
 * @group unit
 * @group framework
 *
 * @covers \Umber\Http\Framework\Symfony\DependencyInjection\UmberHttpExtension
 * @covers \Umber\Http\Framework\Symfony\DependencyInjection\UmberHttpConfiguration
 */
final class UmberHttpExtensionTest extends TestCase
{
    /**
     * @test
     *
     * @throws Exception
     */
    public function canLoadBundleDefinitions(): void
    {
        /** @var ContainerBuilder|MockObject $container */
        $container = $this->createMock(ContainerBuilder::class);
        $container->expects(self::atLeastOnce())
            ->method('fileExists');

        $extension = new UmberHttpExtension();
        $extension->load([], $container);
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function canHandleSerializerWithBlankConfigs(): void
    {
        $configs = [];

        /** @var ContainerBuilder|MockObject $container */
        $container = $this->createMock(ContainerBuilder::class);
        $container->expects(self::never())
            ->method('getDefinition');

        $extension = new UmberHttpExtension();
        $extension->load($configs, $container);
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function canHandleNullSerializerConfiguration(): void
    {
        $configs = [
            [
                'serializer' => null,
            ]
        ];

        /** @var ContainerBuilder|MockObject $container */
        $container = $this->createMock(ContainerBuilder::class);
        $container->expects(self::never())
            ->method('getDefinition');

        $extension = new UmberHttpExtension();
        $extension->load($configs, $container);
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function canHandleSpecifiedSerializerConfiguration(): void
    {
        $configs = [
            [
                'serializer' => 'some.serializer',
            ]
        ];

        /** @var Definition|MockObject $definition */
        $definition = $this->createMock(Definition::class);
        $definition->expects(self::once())
            ->method('replaceArgument')
            ->with(
                1,
                new Reference('some.serializer')
            );

        /** @var ContainerBuilder|MockObject $container */
        $container = $this->createMock(ContainerBuilder::class);
        $container->expects(self::once())
            ->method('getDefinition')
            ->with('umber.http.response.generator.json')
            ->willReturn($definition);

        $extension = new UmberHttpExtension();
        $extension->load($configs, $container);
    }
}
