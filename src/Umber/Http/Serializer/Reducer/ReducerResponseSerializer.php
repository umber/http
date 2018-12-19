<?php

declare(strict_types=1);

namespace Umber\Http\Serializer\Reducer;

use Umber\Http\Serializer\ResponseSerializerInterface;
use Umber\Reducer\Builder\ReducerBuilderFactory;

/**
 * A serializer using the reducer.
 */
final class ReducerResponseSerializer implements ResponseSerializerInterface
{
    private $factory;

    public function __construct(ReducerBuilderFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($data, array $groups): array
    {
        $reduced = $this->factory->create()
            ->groups($groups)
            ->reduce($data);

        return $reduced;
    }
}
