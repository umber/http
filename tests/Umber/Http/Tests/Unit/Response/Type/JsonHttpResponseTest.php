<?php

declare(strict_types=1);

namespace Umber\Http\Tests\Unit\Response\Type;

use Umber\Http\Enum\HttpHeaderEnum;
use Umber\Http\Enum\HttpStatusEnum;
use Umber\Http\Exception\HttpHeaderNotFoundException;
use Umber\Http\Response\Type\JsonHttpResponse;

use PHPUnit\Framework\TestCase;

/**
 * @group unit
 *
 * @covers \Umber\Http\Response\Type\JsonHttpResponse
 */
final class JsonHttpResponseTest extends TestCase
{
    /**
     * @test
     */
    public function canConstructBasicJsonHttpResponse(): void
    {
        $json = [
            'foo' => 'bar',
        ];

        $response = new JsonHttpResponse(HttpStatusEnum::OK, $json);

        self::assertEquals(HttpStatusEnum::OK, $response->getStatusCode());
        self::assertEquals($json, $response->getData());
        self::assertEquals(json_encode($json), $response->getBody());
    }

    /**
     * @test
     */
    public function withStringBodyReturnJsonEncodedString(): void
    {
        $response = new JsonHttpResponse(HttpStatusEnum::OK, 'foo-bar');

        self::assertEquals('foo-bar', $response->getData());
        self::assertEquals('"foo-bar"', $response->getBody());
    }

    /**
     * @test
     */
    public function withEmptyBodyReturnEmptyString(): void
    {
        $response = new JsonHttpResponse(HttpStatusEnum::OK, '');

        self::assertEquals('', $response->getData());
        self::assertEquals('', $response->getBody());
    }

    /**
     * @test
     *
     * @throws HttpHeaderNotFoundException
     */
    public function withNewInstanceContentTypeSet(): void
    {
        $response = new JsonHttpResponse(HttpStatusEnum::OK, null);

        self::assertTrue($response->getHeaders()->has(HttpHeaderEnum::CONTENT_TYPE));
        self::assertEquals('application/json', $response->getHeaders()->get(HttpHeaderEnum::CONTENT_TYPE)->getValue());
    }
}
