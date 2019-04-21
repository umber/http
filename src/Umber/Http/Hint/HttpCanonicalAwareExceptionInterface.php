<?php

declare(strict_types=1);

namespace Umber\Http\Hint;

/**
 * An exception aware of its canonical error message.
 *
 * This can be used to enforce an exception can be correctly represented when serialized
 * and returned to the end user. Canonical messages should be considered unique and never
 * changing which allows the end user to program against them. Think of them as extended
 * status codes but are also human and machine readable.
 */
interface HttpCanonicalAwareExceptionInterface
{
    /**
     * Return a canonical string that allow an application to react to this exception.
     */
    public static function getCanonicalCode(): string;
}
