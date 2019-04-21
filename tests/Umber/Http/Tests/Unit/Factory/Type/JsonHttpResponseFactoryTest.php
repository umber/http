<?php

declare(strict_types=1);

namespace Umber\Http\Tests\Unit\Factory\Type;

use Umber\Http\Enum\HttpStatusEnum;
use Umber\Http\Factory\Type\JsonHttpResponseFactory;
use Umber\Http\Pagination\PaginatorInterface;
use Umber\Http\Response\Type\JsonHttpResponse;
use Umber\Http\Response\Type\JsonPaginatorHttpResponse;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

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
