<?php

declare(strict_types=1);

namespace Umber\Http\Response;

use Umber\Http\Header\Collection\HttpHeaderCollection;

/**
 * A basic HTTP response implementation.
 */
final class HttpResponse implements
    HttpResponseInterface
{
    /** @var HttpHeaderCollection */
    private $headers;

    /** @var int */
    private $status;

    /** @var string */
    private $body;

    public function __construct(int $status, string $body = '')
    {
        $this->headers = new HttpHeaderCollection();
        $this->status = $status;
        $this->body = $body;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusCode(): int
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->body;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders(): HttpHeaderCollection
    {
        return $this->headers;
    }
}
