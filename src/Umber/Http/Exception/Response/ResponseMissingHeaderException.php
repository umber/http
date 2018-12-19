<?php

declare(strict_types=1);

namespace Umber\Http\Exception\Response;

use RuntimeException;

/**
 * An exception thrown when a response does not have a http header when requested.
 */
final class ResponseMissingHeaderException extends RuntimeException
{
    /**
     * @return ResponseMissingHeaderException
     */
    public static function create(string $name): self
    {
        $message = implode(' ', [
            'The current response does not have the header by name "{{name}}".',
            'Please make sure that a response was set with this header before hand.',
            'To check for header by name make use of the "hasHeader()" method against the response.',
        ]);

        return new self(strtr($message, [
            '{{name}}' => $name,
        ]));
    }
}
