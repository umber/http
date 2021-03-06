<?php

declare(strict_types=1);

namespace Umber\Http\Tests\Unit\Response;

use Umber\Http\Enum\HttpStatusEnum;
use Umber\Http\Response\HttpResponse;

use PHPUnit\Framework\TestCase;

/**
 * @group unit
 *
 * @covers \Umber\Http\Response\HttpResponse
 */
final class HttpResponseTest extends TestCase
{
    /**
     * @test
     */
    public function canConstructBasicHttpResponse(): void
    {
        $response = new HttpResponse(HttpStatusEnum::OK, 'foo-bar');

        self::assertEquals(HttpStatusEnum::OK, $response->getStatusCode());
        self::assertEquals('foo-bar', $response->getData());
        self::assertEquals('foo-bar', $response->getBody());
        self::assertEquals(0, $response->getHeaders()->count());
    }
}
