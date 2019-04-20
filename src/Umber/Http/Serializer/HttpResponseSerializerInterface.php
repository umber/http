<?php

declare(strict_types=1);

namespace Umber\Http\Serializer;

use Umber\Http\Response\HttpResponseInterface;

/**
 * A HTTP Response Serializer is an abstract of a serializer.
 *
 * The serializer is not aware of the format that it should be formatting therefore
 * it should either attempt to check the type of the response given or attempt
 * to read the response headers content type.
 */
interface HttpResponseSerializerInterface
{
    /**
     * Convert the given response data to a string.
     *
     * @param string[] $groups
     */
    public function serialize(HttpResponseInterface $response, array $groups): string;
}
