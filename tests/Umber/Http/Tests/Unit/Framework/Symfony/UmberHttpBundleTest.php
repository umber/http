<?php

declare(strict_types=1);

namespace Umber\Http\Tests\Unit\Framework\Symfony;

use Umber\Http\Framework\Symfony\DependencyInjection\UmberHttpExtension;
use Umber\Http\Framework\Symfony\UmberHttpBundle;

use PHPUnit\Framework\TestCase;

/**
 * @group unit
 * @group framework
 *
 * @covers \Umber\Http\Framework\Symfony\UmberHttpBundle
 */
final class UmberHttpBundleTest extends TestCase
{
    /**
     * @test
     */
    public function canRetrieveExtensionClass(): void
    {
        $bundle = new UmberHttpBundle();

        $extension = $bundle->getContainerExtension();

        self::assertInstanceOf(UmberHttpExtension::class, $extension);
    }
}
