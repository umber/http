<?php

declare(strict_types=1);

namespace Umber\Http\Serializer\Response;

use Umber\Http\Header\Collection\HttpHeaderCollection;
use Umber\Http\Response\Hint\HttpResponseProxyInterface;
use Umber\Http\Response\HttpResponseInterface;
use Umber\Http\Serializer\HttpResponseSerializerInterface;

/**
 * A HTTP Response Proxy aware of its serialisation properties.
 */
final class SerializerHttpResponse implements
    HttpResponseInterface,
    HttpResponseProxyInterface
{
    /** @var HttpResponseInterface */
    private $response;

    /** @var HttpResponseSerializerInterface */
    private $serializer;

    /** @var string[] */
    private $groups;

    /**
     * @param string[] $groups
     */
    public function __construct(
        HttpResponseInterface $response,
        HttpResponseSerializerInterface $serializer,
        array $groups
    ) {
        $this->response = $response;
        $this->serializer = $serializer;
        $this->groups = $groups;
    }

    /**
     * {@inheritdoc}
     */
    public function getInternalResponse(): HttpResponseInterface
    {
        return $this->response;
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
        return $this->response->getData();
    }

    /**
     * {@inheritdoc}
     */
    public function getBody(): string
    {
        $body = $this->serializer->serialize($this, $this->groups);

        return $body;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders(): HttpHeaderCollection
    {
        return $this->response->getHeaders();
    }

    /**
     * Return the serializer groups.
     *
     * @return string[]
     */
    public function getSerializerGroups(): array
    {
        return $this->groups;
    }
}
