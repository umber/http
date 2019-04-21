<?php

declare(strict_types=1);

namespace Umber\Http\Response;

use Umber\Http\Enum\HttpStatusEnum;
use Umber\Http\Header\Collection\HttpHeaderCollection;

/**
 * A HTTP response wrapper.
 */
interface HttpResponseInterface
{
    /**
     * Return the response status code.
     *
     * @see HttpStatusEnum
     */
    public function getStatusCode(): int;

    /**
     * Return the response data.
     *
     * @return mixed
     */
    public function getData();

    /**
     * Return the response body.
     *
     * This is the body in a representation that is good to use with a response.
     * For example a transport payload should be serialized at this point.
     */
    public function getBody(): string;

    /**
     * Manage the response headers.
     */
    public function getHeaders(): HttpHeaderCollection;
}
