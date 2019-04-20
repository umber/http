<?php

declare(strict_types=1);

namespace Umber\Http\Response\Type;

use Umber\Http\Header\Collection\HttpHeaderCollection;
use Umber\Http\Pagination\PaginatorInterface;
use Umber\Http\Pagination\PaginatorResponseHelper;
use Umber\Http\Response\Hint\PaginatorAwareHttpResponseInterface;
use Umber\Http\Response\Hint\Type\JsonHttpResponseTypeInterface;

/**
 * A JSON HTTP Response.
 */
final class JsonPaginatorHttpResponse implements
    JsonHttpResponseTypeInterface,
    PaginatorAwareHttpResponseInterface
{
    /** @var JsonHttpResponse */
    private $response;

    /** @var PaginatorInterface */
    private $paginator;

    public function __construct(int $status, PaginatorInterface $paginator)
    {
        $this->response = new JsonHttpResponse($status, null);
        $this->paginator = $paginator;
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
    public function getData(): array
    {
        return $this->getPaginatorData();
    }

    /**
     * {@inheritdoc}
     */
    public function getBody(): string
    {
        /** @var string $json */
        $json = json_encode($this->getPaginatorData());

        return $json;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders(): HttpHeaderCollection
    {
        return $this->response->getHeaders();
    }

    /**
     * {@inheritdoc}
     */
    public function getPaginator(): PaginatorInterface
    {
        return $this->paginator;
    }

    /**
     * Return the paginator data and initialise headers.
     *
     * @return mixed[]
     */
    private function getPaginatorData(): array
    {
        $data = $this->paginator->getPageData();

        // Initialise the paginator headers now that the page data is present.
        // This should be a pretty generic way of initialising the paginator.
        PaginatorResponseHelper::setPaginatorHeaders($this->paginator, $this->getHeaders());

        return $data;
    }
}
