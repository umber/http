<?php

declare(strict_types=1);

namespace Umber\Http\Hint;

/**
 * An exception that is aware of its HTTP Status Code.
 */
interface HttpAwareExceptionInterface
{
    /**
     * Return the HTTP status code.
     *
     * @see HttpStatusEnum
     */
    public static function getStatusCode(): int;
}
