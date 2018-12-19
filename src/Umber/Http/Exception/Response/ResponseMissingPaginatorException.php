<?php

declare(strict_types=1);

namespace Umber\Http\Exception\Response;

use RuntimeException;

/**
 * An exception thrown when a response does not have a pagination when requested.
 */
final class ResponseMissingPaginatorException extends RuntimeException
{
    /**
     * @return ResponseMissingPaginatorException
     */
    public static function create(): self
    {
        $message = implode(' ', [
            'The current response does not have a paginator.',
            'Please make sure that a paginator was set before hand.',
            'To check for paginator make use of the "hasPaginator()" method against the response.',
        ]);

        return new self($message);
    }
}
