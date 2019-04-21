<?php

declare(strict_types=1);

namespace Umber\Http\Tests\Unit\Header\Factory;

use Umber\Http\Enum\HttpHeaderEnum;
use Umber\Http\Header\Factory\HttpHeaderFactory;

use PHPUnit\Framework\TestCase;

/**
 * @group unit
 *
 * @covers \Umber\Http\Header\Factory\HttpHeaderFactory
 */
final class HttpHeaderFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function canConstructContentTypeHeader(): void
    {
        $header = HttpHeaderFactory::createContentType('foo-bar');

        self::assertEquals(HttpHeaderEnum::CONTENT_TYPE, $header->getName());
        self::assertEquals('foo-bar', $header->getValue());
    }
}
