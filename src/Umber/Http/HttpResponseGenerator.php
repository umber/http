<?php

declare(strict_types=1);

namespace Umber\Http;

use Umber\Database\Pagination\PaginatorInterface;

use Symfony\Component\HttpFoundation\Response;

/**
 * A helper for generating common HTTP responses.
 */
/* final */class HttpResponseGenerator
{
    private $composer;
    private $type;

    public function __construct(HttpResponseComposer $composer, string $type)
    {
        $this->composer = $composer;
        $this->type = $type;
    }

    /**
     * Generate a HTTP response.
     *
     * @param mixed|mixed[]|PaginatorInterface $data
     * @param string[] $groups
     */
    public function generate(int $status, $data, array $groups): HttpResponseInterface
    {
        return $this->composer->compose($this->type, $status, $data, $groups);
    }

    /**
     * Generate a 200 OK.
     *
     * @param mixed|mixed[]|PaginatorInterface $data
     * @param string[] $groups
     */
    public function ok($data, array $groups = []): HttpResponseInterface
    {
        return $this->generate(Response::HTTP_OK, $data, $groups);
    }

    /**
     * Generate a 204 NO CONTENT.
     */
    public function noContent(): HttpResponseInterface
    {
        return $this->generate(Response::HTTP_NO_CONTENT, null, []);
    }

    /**
     * Generate a 400 BAD REQUEST.
     *
     * @param mixed|mixed[]|PaginatorInterface $data
     * @param string[] $groups
     */
    public function badRequest($data, array $groups = []): HttpResponseInterface
    {
        return $this->generate(Response::HTTP_BAD_REQUEST, $data, $groups);
    }

    /**
     * Generate a 404 NOT FOUND.
     *
     * @param mixed|mixed[]|PaginatorInterface $data
     * @param string[] $groups
     */
    public function notFound($data, array $groups = []): HttpResponseInterface
    {
        return $this->generate(Response::HTTP_NOT_FOUND, $data, $groups);
    }
}
