<?php

declare(strict_types=1);

namespace Umber\Http\Response\Hint;

use Umber\Http\Response\HttpResponseInterface;

/**
 * An HTTP Response Proxy is an response wrapping another response.
 * This can be used to detect these kinds of responses and handle accordingly.
 */
interface HttpResponseProxyInterface
{
    /**
     * Return the internal response.
     */
    public function getInternalResponse(): HttpResponseInterface;
}
