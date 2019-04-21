<?php

declare(strict_types=1);

namespace Umber\Http\Framework\Symfony\Event;

use Umber\Http\Response\HttpResponseInterface;

use Symfony\Component\EventDispatcher\Event;

/**
 * An event fired before the event is transformed to a Symfony Response.
 */
final class BeforeResponseTransformEvent extends Event
{
    public const EVENT_NAME = 'umber.before.response_transform';

    /** @var HttpResponseInterface */
    private $response;

    public function __construct(HttpResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Return the HTTP Response.
     */
    public function getResponse(): HttpResponseInterface
    {
        return $this->response;
    }
}
