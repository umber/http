<?php

declare(strict_types=1);

namespace Umber\Http\Tests\Unit\Header;

use Umber\Http\Header\HttpHeader;

use PHPUnit\Framework\TestCase;

/**
 * @group unit
 *
 * @covers \Umber\Http\Header\HttpHeader
 */
final class HttpHeaderTest extends TestCase
{
    /**
     * @test
     */
    public function canConstructBasicHeader(): void
    {
        $header = HttpHeader::create('Foo', 'Bar');

        self::assertEquals('Foo', $header->getName());
        self::assertEquals('Bar', $header->getValue());
    }

    /**
     * @test
     */
    public function canRepresentAsString(): void
    {
        $header = HttpHeader::create('Authorisation', 'Bearer KEY');

        $expected = 'Authorisation: Bearer KEY';

        self::assertEquals($expected, $header->toString());
    }
}
