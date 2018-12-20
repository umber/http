<?php

declare(strict_types=1);

namespace Umber\Http;

use Umber\Database\Pagination\PaginatorInterface;
use Umber\Http\Factory\HttpFactoryInterface;
use Umber\Http\Serializer\ResponseSerializerInterface;

/**
 * A helper for composing responses.
 */
final class HttpResponseComposer
{
    private $factory;
    private $serializer;

    public function __construct(HttpFactoryInterface $factory, ResponseSerializerInterface $serializer)
    {
        $this->factory = $factory;
        $this->serializer = $serializer;
    }

    /**
     * Compose a HTTP response.
     *
     * @param mixed|mixed[]|PaginatorInterface $data
     * @param string[] $groups
     */
    public function compose(string $type, int $status, $data, array $groups): HttpResponseInterface
    {
        $paginator = $data;

        if ($paginator instanceof PaginatorInterface) {
            $data = $paginator->asArray();
        }

        // Only serialise when data is not null.
        // 204 NO CONTENT requests will have a null data.
        if ($data !== null) {
            $data = $this->serializer->serialize($data, $groups);
        }

        $response = $this->factory->create($type, $status, $data);

        if ($paginator instanceof PaginatorInterface) {
            $response->setPaginator($paginator);
        }

        return $response;
    }
}
