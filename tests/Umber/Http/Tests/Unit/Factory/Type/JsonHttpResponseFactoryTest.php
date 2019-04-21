<?php

namespace Umber\Http\Tests\Unit\Factory\Type;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Umber\Http\Enum\HttpStatusEnum;
use Umber\Http\Exception\Factory\HttpResponseContentTypeUnsupportedException;
use Umber\Http\Factory\Type\JsonHttpResponseFactory;
use Umber\Http\Pagination\PaginatorInterface;
use Umber\Http\Response\Hint\Type\JsonHttpResponseTypeInterface;
use Umber\Http\Response\HttpResponse;
use Umber\Http\Response\Type\JsonHttpResponse;
use Umber\Http\Response\Type\JsonPaginatorHttpResponse;

/**
 * @group unit
 *
 * @covers \Umber\Http\Factory\Type\JsonHttpResponseFactory
 */
final class JsonHttpResponseFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function canCreateJsonHttpResponse(): void
    {
        $factory = new JsonHttpResponseFactory();

        /** @var JsonHttpResponse $response */
        $response = $factory->create(HttpStatusEnum::OK, []);

        self::assertInstanceOf(JsonHttpResponse::class, $response);
        self::assertEquals([], $response->getData());
        self::assertEquals('[]', $response->getBody());
        self::assertEquals(HttpStatusEnum::OK, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function withPaginatorCanCreateJsonPaginatorHttpResponse(): void
    {
        $factory = new JsonHttpResponseFactory();

        /** @var PaginatorInterface|MockObject $paginator */
        $paginator = $this->createMock(PaginatorInterface::class);

        /** @var JsonPaginatorHttpResponse $response */
        $response = $factory->create(HttpStatusEnum::OK, $paginator);

        self::assertInstanceOf(JsonPaginatorHttpResponse::class, $response);
        self::assertSame($paginator, $response->getPaginator());
        self::assertEquals([], $response->getData());
        self::assertEquals('[]', $response->getBody());
        self::assertEquals(HttpStatusEnum::OK, $response->getStatusCode());
    }
}
