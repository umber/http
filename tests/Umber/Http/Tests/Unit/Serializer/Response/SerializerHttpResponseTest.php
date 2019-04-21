<?php

declare(strict_types=1);

namespace Umber\Http\Tests\Unit\Serializer\Response;

use Umber\Http\Enum\HttpStatusEnum;
use Umber\Http\Response\Type\JsonHttpResponse;
use Umber\Http\Serializer\HttpResponseSerializerInterface;
use Umber\Http\Serializer\Response\SerializerHttpResponse;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 *
 * @covers \Umber\Http\Serializer\Response\SerializerHttpResponse
 */
final class SerializerHttpResponseTest extends TestCase
{
    /**
     * @test
     */
    public function withSerializerResponseSerializeLate(): void
    {
        $json = [
            'foo' => 'bar',
            'tony' => 'stark',
        ];

        $groups = [
            'foo',
            'bar',
        ];

        /** @var MockObject|HttpResponseSerializerInterface $serializer */
        $serializer = $this->createMock(HttpResponseSerializerInterface::class);
        $serializer->expects(self::never())
            ->method('serialize');

        $internal = new JsonHttpResponse(HttpStatusEnum::OK, $json);
        $response = new SerializerHttpResponse($internal, $serializer, $groups);

        self::assertSame($internal, $response->getInternalResponse());
        self::assertEquals($groups, $response->getSerializerGroups());

        self::assertEquals(HttpStatusEnum::OK, $response->getStatusCode());
        self::assertEquals($json, $response->getData());
        self::assertEquals(1, $response->getHeaders()->count());
    }

    /**
     * @test
     */
    public function canSerializeData(): void
    {
        $json = [
            'foo' => 'bar',
            'tony' => 'stark',
        ];

        $groups = [
            'foo',
            'bar',
        ];

        /** @var MockObject|HttpResponseSerializerInterface $serializer */
        $serializer = $this->createMock(HttpResponseSerializerInterface::class);
        $serializer->expects(self::once())
            ->method('serialize')
            ->with(
                self::anything(),
                $groups
            )
            ->willReturn('{serialized}');

        $internal = new JsonHttpResponse(HttpStatusEnum::OK, $json);
        $response = new SerializerHttpResponse($internal, $serializer, $groups);

        self::assertEquals('{serialized}', $response->getBody());
    }
}
