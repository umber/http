<?php

declare(strict_types=1);

namespace Umber\Http\Tests\Unit\Factory\Type;

use Umber\Http\Enum\HttpStatusEnum;
use Umber\Http\Factory\Type\JsonHttpResponseFactory;
use Umber\Http\Factory\Type\JsonHttpResponseGenerator;
use Umber\Http\Pagination\PaginatorInterface;
use Umber\Http\Response\Type\JsonHttpResponse;
use Umber\Http\Response\Type\JsonPaginatorHttpResponse;
use Umber\Http\Serializer\HttpResponseSerializerInterface;
use Umber\Http\Serializer\Response\SerializerHttpResponse;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 *
 * @covers \Umber\Http\Factory\Type\JsonHttpResponseGenerator
 */
final class JsonHttpResponseGeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function canGenerateResponseWithoutSerializer(): void
    {
        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, null);

        /** @var JsonHttpResponse $response */
        $response = $generator->generate(HttpStatusEnum::OK, null);

        self::assertInstanceOf(JsonHttpResponse::class, $response);
    }

    /**
     * @test
     */
    public function canGeneratePaginatorResponseWithoutSerializer(): void
    {
        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, null);

        /** @var PaginatorInterface|MockObject $paginator */
        $paginator = $this->createMock(PaginatorInterface::class);

        /** @var JsonPaginatorHttpResponse $response */
        $response = $generator->generate(HttpStatusEnum::OK, $paginator);

        self::assertInstanceOf(JsonPaginatorHttpResponse::class, $response);
    }

    /**
     * @test
     */
    public function canGenerateResponseWithSerializer(): void
    {
        /** @var HttpResponseSerializerInterface|MockObject $serializer */
        $serializer = $this->createMock(HttpResponseSerializerInterface::class);

        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, $serializer);

        /** @var SerializerHttpResponse $response */
        $response = $generator->generate(HttpStatusEnum::OK, null);

        self::assertInstanceOf(SerializerHttpResponse::class, $response);
        self::assertInstanceOf(JsonHttpResponse::class, $response->getInternalResponse());
    }

    /**
     * @test
     */
    public function canGeneratePaginatorResponseWithSerializer(): void
    {
        /** @var HttpResponseSerializerInterface|MockObject $serializer */
        $serializer = $this->createMock(HttpResponseSerializerInterface::class);

        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, $serializer);

        /** @var PaginatorInterface|MockObject $paginator */
        $paginator = $this->createMock(PaginatorInterface::class);

        /** @var SerializerHttpResponse $response */
        $response = $generator->generate(HttpStatusEnum::OK, $paginator);

        self::assertInstanceOf(SerializerHttpResponse::class, $response);
        self::assertInstanceOf(JsonPaginatorHttpResponse::class, $response->getInternalResponse());
    }

    /**
     * @test
     */
    public function canCreateResponseUsingMethodOk(): void
    {
        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, null);

        $json = [
            'foo' => 'bar',
            'tony' => 'stark',
        ];

        $response = $generator->ok($json);

        self::assertEquals(HttpStatusEnum::OK, $response->getStatusCode());
        self::assertEquals($json, $response->getData());
    }

    /**
     * @test
     */
    public function canCreateResponseUsingMethodCreated(): void
    {
        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, null);

        $json = [
            'foo' => 'bar',
            'tony' => 'stark',
        ];

        $response = $generator->created($json);

        self::assertEquals(HttpStatusEnum::CREATED, $response->getStatusCode());
        self::assertEquals($json, $response->getData());
    }

    /**
     * @test
     */
    public function canCreateResponseUsingMethodAccepted(): void
    {
        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, null);

        $json = [
            'foo' => 'bar',
            'tony' => 'stark',
        ];

        $response = $generator->accepted($json);

        self::assertEquals(HttpStatusEnum::ACCEPTED, $response->getStatusCode());
        self::assertEquals($json, $response->getData());
    }

    /**
     * @test
     */
    public function canCreateResponseUsingMethodNoContent(): void
    {
        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, null);

        $response = $generator->noContent();

        self::assertEquals(HttpStatusEnum::NO_CONTENT, $response->getStatusCode());
        self::assertEquals('', $response->getData());
    }

    /**
     * @test
     */
    public function canCreateResponseUsingMethodBadRequest(): void
    {
        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, null);

        $json = [
            'foo' => 'bar',
            'tony' => 'stark',
        ];

        $response = $generator->badRequest($json);

        self::assertEquals(HttpStatusEnum::BAD_REQUEST, $response->getStatusCode());
        self::assertEquals($json, $response->getData());
    }

    /**
     * @test
     */
    public function canCreateResponseUsingMethodNotFound(): void
    {
        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, null);

        $json = [
            'foo' => 'bar',
            'tony' => 'stark',
        ];

        $response = $generator->notFound($json);

        self::assertEquals(HttpStatusEnum::NOT_FOUND, $response->getStatusCode());
        self::assertEquals($json, $response->getData());
    }

    /**
     * @test
     */
    public function canCreateResponseUsingMethodNotAcceptable(): void
    {
        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, null);

        $json = [
            'foo' => 'bar',
            'tony' => 'stark',
        ];

        $response = $generator->notAcceptable($json);

        self::assertEquals(HttpStatusEnum::NOT_ACCEPTABLE, $response->getStatusCode());
        self::assertEquals($json, $response->getData());
    }

    /**
     * @test
     */
    public function canCreateResponseUsingMethodConflict(): void
    {
        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, null);

        $json = [
            'foo' => 'bar',
            'tony' => 'stark',
        ];

        $response = $generator->conflict($json);

        self::assertEquals(HttpStatusEnum::CONFLICT, $response->getStatusCode());
        self::assertEquals($json, $response->getData());
    }

    /**
     * @test
     */
    public function canCreateResponseUsingMethodUnprocessableEntity(): void
    {
        $factory = new JsonHttpResponseFactory();
        $generator = new JsonHttpResponseGenerator($factory, null);

        $json = [
            'foo' => 'bar',
            'tony' => 'stark',
        ];

        $response = $generator->unprocessableEntity($json);

        self::assertEquals(HttpStatusEnum::UNPROCESSABLE_ENTITY, $response->getStatusCode());
        self::assertEquals($json, $response->getData());
    }
}
