<?php

namespace Umber\Http\Tests\Unit\Response\Type;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Umber\Http\Enum\HttpHeaderEnum;
use Umber\Http\Enum\HttpStatusEnum;
use Umber\Http\Exception\HttpHeaderNotFoundException;
use Umber\Http\Pagination\PaginatorInterface;
use Umber\Http\Response\Type\JsonHttpResponse;
use Umber\Http\Response\Type\JsonPaginatorHttpResponse;

/**
 * @group unit
 *
 * @covers \Umber\Http\Response\Type\JsonPaginatorHttpResponse
 */
final class JsonPaginatorHttpResponseTest extends TestCase
{
    /**
     * @test
     */
    public function canConstructBasicJsonHttpResponse(): void
    {
        $json = [
            'foo' => 'bar',
            'pepper' => 'stark',
        ];

        /** @var PaginatorInterface|MockObject $paginator */
        $paginator = $this->createMock(PaginatorInterface::class);
        $paginator->expects(self::exactly(2))
            ->method('getPageData')
            ->willReturn($json);

        $response = new JsonPaginatorHttpResponse(HttpStatusEnum::OK, $paginator);

        self::assertSame($paginator, $response->getPaginator());
        self::assertEquals(HttpStatusEnum::OK, $response->getStatusCode());
        self::assertEquals($json, $response->getData());
        self::assertEquals(json_encode($json), $response->getBody());
        self::assertEquals(5, $response->getHeaders()->count());
    }

    /**
     * @test
     *
     * @throws HttpHeaderNotFoundException
     */
    public function withNewInstanceContentTypeSet(): void
    {
        /** @var PaginatorInterface|MockObject $paginator */
        $paginator = $this->createMock(PaginatorInterface::class);

        $response = new JsonPaginatorHttpResponse(HttpStatusEnum::OK, $paginator);

        self::assertTrue($response->getHeaders()->has(HttpHeaderEnum::CONTENT_TYPE));
        self::assertEquals('application/json', $response->getHeaders()->get(HttpHeaderEnum::CONTENT_TYPE)->getValue());
    }
}
