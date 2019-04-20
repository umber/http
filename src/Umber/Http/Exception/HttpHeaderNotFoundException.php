<?php

declare(strict_types=1);

namespace Umber\Http\Exception;

use Exception;

/**
 * A header cannot be found in the header collection.
 */
final class HttpHeaderNotFoundException extends Exception
{
    /** @var string */
    private $header;

    /**
     * @return HttpHeaderNotFoundException
     */
    public static function create(string $header): self
    {
        return new self($header);
    }

    public function __construct(string $header)
    {
        $message = 'Cannot find header "%s" in header collection.';
        $message = sprintf($message, $header);

        parent::__construct($message);

        $this->header = $header;
    }

    /**
     * Return the header name.
     */
    public function getHeaderName(): string
    {
        return $this->header;
    }
}
