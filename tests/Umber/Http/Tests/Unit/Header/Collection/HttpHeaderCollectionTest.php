<?php

namespace Umber\Http\Tests\Unit\Header\Collection;

use PHPUnit\Framework\TestCase;
use Umber\Http\Exception\HttpHeaderNotFoundException;
use Umber\Http\Header\HttpHeader;
use Umber\Http\Header\Collection\HttpHeaderCollection;

/**
 * @group unit
 *
 * @covers \Umber\Http\Header\Collection\HttpHeaderCollection
 */
final class HttpHeaderCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function checkNewInstanceIsEmpty(): void
    {
        $collection = new HttpHeaderCollection();

        self::assertEquals(0, $collection->count());
        self::assertEquals([], $collection->all());
    }

    /**
     * @test
     */
    public function canConstructWithHeaderArray(): void
    {
        $collection = new HttpHeaderCollection([
            HttpHeader::create('Foo', 'foo-value'),
            HttpHeader::create('Bar', 'bar-value'),
        ]);

        self::assertEquals(2, $collection->count());
    }

    /**
     * @test
     */
    public function canAddHeaderManually(): void
    {
        $header = HttpHeader::create('Foo', 'foo-value');

        $collection = new HttpHeaderCollection();
        $collection->add($header);

        self::assertEquals(1, $collection->count());
    }

    /**
     * @test
     */
    public function canCheckHeaderExistence(): void
    {
        $header = HttpHeader::create('Foo', 'Bar');

        $collection = new HttpHeaderCollection();
        $collection->add($header);

        self::assertTrue($collection->has('Foo'));
        self::assertFalse($collection->has('Bar'));
    }

    /**
     * @test
     *
     * @throws HttpHeaderNotFoundException
     */
    public function canGetHeader(): void
    {
        $header = HttpHeader::create('Foo', 'Bar');

        $collection = new HttpHeaderCollection();
        $collection->add($header);

        self::assertSame($header, $collection->get('Foo'));
    }

    /**
     * @test
     *
     * @covers \Umber\Http\Exception\HttpHeaderNotFoundException
     */
    public function withHeaderMissingGetWillThrow(): void
    {
        $collection = new HttpHeaderCollection();

        try {
            $collection->get('Foo');
        } catch (HttpHeaderNotFoundException $exception) {
            $message = 'Cannot find header "Foo" in header collection.';

            self::assertEquals($message, $exception->getMessage());
            self::assertEquals('Foo', $exception->getHeaderName());

            return;
        }

        self::fail(sprintf('Expected exception: %s', HttpHeaderNotFoundException::class));
    }

    /**
     * @test
     */
    public function canGetHeaderCollectionAsArray(): void
    {
        $collection = new HttpHeaderCollection();
        $collection->add(HttpHeader::create('Foo', 'Bar'));
        $collection->add(HttpHeader::create('Tony', 'Stark'));
        $collection->add(HttpHeader::create('Hello', 'World'));

        $expected = [
            'Foo' => 'Bar',
            'Tony' => 'Stark',
            'Hello' => 'World',
        ];

        self::assertSame($expected, $collection->toArray());
    }
}
