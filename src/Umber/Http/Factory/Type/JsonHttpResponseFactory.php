<?php

declare(strict_types=1);

namespace Umber\Http\Factory\Type;

use Umber\Http\Pagination\PaginatorInterface;
use Umber\Http\Response\HttpResponseInterface;
use Umber\Http\Response\Type\JsonHttpResponse;
use Umber\Http\Response\Type\JsonPaginatorHttpResponse;

/**
 * {@inheritdoc}
 */
final class JsonHttpResponseFactory implements
    JsonHttpResponseFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(int $status, $data): HttpResponseInterface
    {
        if ($data instanceof PaginatorInterface) {
            $response = new JsonPaginatorHttpResponse($status, $data);

            return $response;
        }

        $response = new JsonHttpResponse($status, $data);

        return $response;
    }
}
