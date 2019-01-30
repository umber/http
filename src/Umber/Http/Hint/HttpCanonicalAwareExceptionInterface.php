<?php

declare(strict_types=1);

namespace Umber\Http\Hint;

/**
 * A canonical aware exception will provide a unique canonical string that
 * applications can program against if chosen to be exposed.
 */
interface HttpCanonicalAwareExceptionInterface
{
    /**
     * Return a canonical string that allow an application to react to this exception.
     */
    public static function getCanonicalCode(): string;
}
