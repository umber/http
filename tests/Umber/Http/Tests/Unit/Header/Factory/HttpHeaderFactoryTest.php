<?php

namespace Umber\Http\Tests\Unit\Header\Factory;

use PHPUnit\Framework\TestCase;
use Umber\Http\Enum\HttpHeaderEnum;
use Umber\Http\Header\Factory\HttpHeaderFactory;

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
