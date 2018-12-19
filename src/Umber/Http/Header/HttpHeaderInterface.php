<?php

declare(strict_types=1);

namespace Umber\Http\Header;

/**
 * A HTTP header representation.
 */
interface HttpHeaderInterface
{
    /**
     * Return the header name.
     */
    public function getName(): string;

    /**
     * Return the header value.
     */
    public function getValue(): string;

    /**
     * Should the header be exposed through access control.
     */
    public function isExposed(): bool;
}
