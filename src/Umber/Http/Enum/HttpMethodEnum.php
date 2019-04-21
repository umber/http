<?php

declare(strict_types=1);

namespace Umber\Http\Enum;

/**
 * HTTP Methods
 */
final class HttpMethodEnum
{
    public const OPTIONS = 'OPTIONS';
    public const HEAD = 'HEAD';
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const PATCH = 'PATCH';
    public const DELETE = 'DELETE';

    public const LINK = 'LINK';
    public const UNLINK = 'UNLINK';
}
