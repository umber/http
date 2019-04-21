<?php

declare(strict_types=1);

namespace Umber\Http\Header\Collection;

use Umber\Http\Exception\HttpHeaderNotFoundException;
use Umber\Http\Header\HttpHeaderInterface;

use Countable;

/**
 * A collection of Http Headers.
 *
 * @see HttpHeaderInterface
 */
final class HttpHeaderCollection implements Countable
{
    /** @var HttpHeaderInterface[] */
    private $collection = [];

    /**
     * @param HttpHeaderInterface[] $collection
     */
    public function __construct(array $collection = [])
    {
        foreach ($collection as $header) {
            $this->add($header);
        }
    }

    /**
     * Check if a header has been set.
     */
    public function has(string $name): bool
    {
        $key = $this->normalise($name);

        return isset($this->collection[$key]);
    }

    /**
     * Return a header by name.
     *
     * @throws HttpHeaderNotFoundException
     */
    public function get(string $name): HttpHeaderInterface
    {
        $key = $this->normalise($name);

        if (isset($this->collection[$key]) === false) {
            throw HttpHeaderNotFoundException::create($name);
        }

        return $this->collection[$key];
    }

    /**
     * Add a header.
     */
    public function add(HttpHeaderInterface $header): void
    {
        $key = $this->normalise($header->getName());

        $this->collection[$key] = $header;
    }

    /**
     * Return all headers.
     *
     * @return HttpHeaderInterface[]
     */
    public function all(): array
    {
        return $this->collection;
    }

    /**
     * Return the header collection as a key-value array.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        $headers = [];

        foreach ($this->collection as $header) {
            $name = $header->getName();
            $headers[$name] = $header->getValue();
        }

        return $headers;
    }

    /**
     * Return the collection count.
     */
    public function count(): int
    {
        return count($this->collection);
    }

    /**
     * Normalise the HTTP header name.
     *
     * Header names are case insensitive therefore we can store them in the collection in lowercase.
     */
    private function normalise(string $name): string
    {
        return strtolower($name);
    }
}
