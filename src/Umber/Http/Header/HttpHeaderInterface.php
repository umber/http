<?php

declare(strict_types=1);

namespace Umber\Http\Header;

use Umber\Http\Enum\HttpHeaderEnum;

/**
 * A basic HTTP header representation.
 */
interface HttpHeaderInterface
{
    /**
     * Return the header name.
     *
     * @see HttpHeaderEnum
     */
    public function getName(): string;

    /**
     * Return the header value.
     */
    public function getValue(): string;

    /**
     * Return the header as a string.
     */
    public function toString(): string;
}
