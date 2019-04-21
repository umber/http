<?php

namespace Umber\Http\Tests\Unit\Framework\Symfony\Event;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Umber\Http\Framework\Symfony\Event\BeforeResponseTransformEvent;
use Umber\Http\Response\HttpResponseInterface;

/**
 * @group unit
 * @group framework
 *
 * @covers \Umber\Http\Framework\Symfony\Event\BeforeResponseTransformEvent
 */
final class BeforeResponseTransformEventTest extends TestCase
{
    /**
     * @test
     */
    public function canConstructAndReturnResponse(): void
    {
        /** @var HttpResponseInterface|MockObject $response */
        $response = $this->createMock(HttpResponseInterface::class);

        $event = new BeforeResponseTransformEvent($response);

        self::assertSame($response, $event->getResponse());
    }
}
