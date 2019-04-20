<?php

declare(strict_types=1);

namespace Umber\Http\Factory\Type;

use Umber\Http\Response\HttpResponseInterface;

interface JsonHttpResponseFactoryInterface
{
    /**
     * Create a JSON HTTP Response.
     *
     * @param mixed $data
     */
    public function create(int $status, $data): HttpResponseInterface;
}
