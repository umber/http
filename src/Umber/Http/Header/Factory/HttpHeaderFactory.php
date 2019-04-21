<?php

declare(strict_types=1);

namespace Umber\Http\Header\Factory;

use Umber\Http\Enum\HttpHeaderEnum;
use Umber\Http\Header\HttpHeader;

/**
 * A factory for creating generic HTTP headers.
 */
final class HttpHeaderFactory
{
    /**
     * Create a Content Type HTTP Header.
     */
    public static function createContentType(string $value): HttpHeader
    {
        return HttpHeader::create(HttpHeaderEnum::CONTENT_TYPE, $value);
    }
}
