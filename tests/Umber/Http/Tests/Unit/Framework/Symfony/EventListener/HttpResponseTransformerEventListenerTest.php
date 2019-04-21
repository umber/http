<?php

declare(strict_types=1);

namespace Umber\Http\Tests\Unit\Framework\Symfony\EventListener;

use Umber\Http\Enum\HttpStatusEnum;
use Umber\Http\Framework\Symfony\Event\BeforeResponseTransformEvent;
use Umber\Http\Framework\Symfony\EventListener\HttpResponseTransformerEventListener;
use Umber\Http\Header\Collection\HttpHeaderCollection;
use Umber\Http\Header\HttpHeader;
use Umber\Http\Response\HttpResponseInterface;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 * @group framework
 *
 * @covers \Umber\Http\Framework\Symfony\EventListener\HttpResponseTransformerEventListener
 */
final class HttpResponseTransformerEventListenerTest extends TestCase
{
    /**
     * @test
     */
    public function withMasterRequestDoNothing(): void
    {
        /** @var GetResponseForControllerResultEvent|MockObject $event */
        $event = $this->createMock(GetResponseForControllerResultEvent::class);
        $event->expects(self::once())
            ->method('isMasterRequest')
            ->willReturn(false);

        $event->expects(self::never())
            ->method('getControllerResult');

        /** @var EventDispatcherInterface|MockObject $dispatcher */
        $dispatcher = $this->createMock(EventDispatcherInterface::class);
        $dispatcher->expects(self::never())
            ->method('dispatch');

        $listener = new HttpResponseTransformerEventListener($dispatcher);
        $listener->onKernelView($event);
    }

    /**
     * @test
     */
    public function withResultNotHttpResponseDoNothing(): void
    {
        /** @var GetResponseForControllerResultEvent|MockObject $event */
        $event = $this->createMock(GetResponseForControllerResultEvent::class);
        $event->expects(self::once())
            ->method('isMasterRequest')
            ->willReturn(true);

        $event->expects(self::once())
            ->method('getControllerResult')
            ->willReturn(null);

        /** @var EventDispatcherInterface|MockObject $dispatcher */
        $dispatcher = $this->createMock(EventDispatcherInterface::class);
        $dispatcher->expects(self::never())
            ->method('dispatch');

        $listener = new HttpResponseTransformerEventListener($dispatcher);
        $listener->onKernelView($event);
    }

    /**
     * @test
     */
    public function withHttpResponseTransform(): void
    {
        $headers = new HttpHeaderCollection();
        $headers->add(HttpHeader::create('Foo', 'Bar'));

        /** @var HttpResponseInterface|MockObject $response */
        $response = $this->createMock(HttpResponseInterface::class);
        $response->expects(self::once())
            ->method('getHeaders')
            ->willReturn($headers);

        $response->expects(self::once())
            ->method('getStatusCode')
            ->willReturn(HttpStatusEnum::OK);

        $response->expects(self::once())
            ->method('getBody')
            ->willReturn('foo');

        /** @var GetResponseForControllerResultEvent|MockObject $event */
        $event = $this->createMock(GetResponseForControllerResultEvent::class);
        $event->expects(self::once())
            ->method('isMasterRequest')
            ->willReturn(true);

        $event->expects(self::once())
            ->method('getControllerResult')
            ->willReturn($response);

        $event->expects(self::once())
            ->method('setResponse')
            ->with(
                self::callback(static function (Response $response) {
                    self::assertEquals(HttpStatusEnum::OK, $response->getStatusCode());
                    self::assertEquals('foo', $response->getContent());
                    self::assertTrue($response->headers->has('Foo'));

                    return true;
                })
            );

        /** @var EventDispatcherInterface|MockObject $dispatcher */
        $dispatcher = $this->createMock(EventDispatcherInterface::class);
        $dispatcher->expects(self::once())
            ->method('dispatch')
            ->with(
                BeforeResponseTransformEvent::EVENT_NAME,
                new BeforeResponseTransformEvent($response)
            );

        $listener = new HttpResponseTransformerEventListener($dispatcher);
        $listener->onKernelView($event);
    }
}
