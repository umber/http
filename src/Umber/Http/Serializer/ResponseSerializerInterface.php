<?php

declare(strict_types=1);

namespace Umber\Http\Serializer;

interface ResponseSerializerInterface
{
    /**
     * {@inheritdoc}
     *
     * @param string|array $data
     * @param string[] $groups
     *
     * @return array
     */
    public function serialize($data, array $groups): array;
}
