<?php

declare(strict_types=1);

namespace Umber\Http\Framework\Symfony\EventListener;

use Umber\Http\Framework\Symfony\Response\SymfonyHttpResponseTransformer;
use Umber\Http\Response\HttpResponseInterface;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

/**
 * A Symfony event listener to listen for controller responses and transform
 * them where required to the framework specific responses.
 */
final class HttpResponseTransformerEventListener
{
    /** @var SymfonyHttpResponseTransformer */
    private $transformer;

    public function __construct(SymfonyHttpResponseTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Handle controller responses.
     */
    public function onKernelView(GetResponseForControllerResultEvent $event): void
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $response = $event->getControllerResult();

        if (!($response instanceof HttpResponseInterface)) {
            return;
        }

        $transformed = $this->transformer->transform($response, $event->getRequest());
        $event->setResponse($transformed);
    }
}
