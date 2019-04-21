<?php

declare(strict_types=1);

namespace Umber\Http\Framework\Symfony\EventListener;

use Umber\Http\Framework\Symfony\Event\BeforeResponseTransformEvent;
use Umber\Http\Response\HttpResponseInterface;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

/**
 * A Symfony event listener to listen for controller responses and transform
 * them where required to the framework specific responses.
 */
final class HttpResponseTransformerEventListener
{
    /** @var EventDispatcherInterface */
    private $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Handle controller responses.
     */
    public function onKernelView(GetResponseForControllerResultEvent $event): void
    {
        if ($event->isMasterRequest() === false) {
            return;
        }

        $response = $event->getControllerResult();

        if (!($response instanceof HttpResponseInterface)) {
            return;
        }

        $this->dispatcher->dispatch(
            BeforeResponseTransformEvent::EVENT_NAME,
            new BeforeResponseTransformEvent($response)
        );

        $transformed = new Response(
            $response->getBody(),
            $response->getStatusCode(),
            $response->getHeaders()->toArray()
        );

        $event->setResponse($transformed);
    }
}
