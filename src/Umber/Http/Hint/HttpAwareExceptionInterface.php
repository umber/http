<?php

declare(strict_types=1);

namespace Umber\Http\Hint;

/**
 * A http aware exception is aware of the status code it should cause.
 */
interface HttpAwareExceptionInterface
{
    /**
     * Return the HTTP status code.
     */
    public static function getStatusCode(): int;
}
