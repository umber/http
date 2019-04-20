<?php

declare(strict_types=1);

namespace Umber\Http\Response\Type;

use Umber\Http\Header\Collection\HttpHeaderCollection;
use Umber\Http\Header\Factory\HttpHeaderFactory;
use Umber\Http\Response\Hint\Type\JsonHttpResponseTypeInterface;
use Umber\Http\Response\HttpResponse;

/**
 * A JSON HTTP Response.
 */
final class JsonHttpResponse implements
    JsonHttpResponseTypeInterface
{
    /** @var HttpResponse */
    private $response;

    /** @var mixed */
    private $data;

    /**
     * @param mixed $data
     */
    public function __construct(int $status, $data)
    {
        $this->response = new HttpResponse($status);
        $this->response->getHeaders()->add(HttpHeaderFactory::createContentType('application/json'));

        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody(): string
    {
        if ($this->data === '') {
            return $this->data;
        }

        /** @var string $json */
        $json = json_encode($this->data);

        return $json;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders(): HttpHeaderCollection
    {
        return $this->response->getHeaders();
    }
}
