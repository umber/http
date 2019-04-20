<?php

declare(strict_types=1);

namespace Umber\Http\Header;

/**
 * A basic HTTP header implementation.
 */
final class HttpHeader implements
    HttpHeaderInterface
{
    /** @var string */
    private $name;

    /** @var string */
    private $value;

    /**
     * Create a HTTP header.
     *
     * @return HttpHeader
     */
    public static function create(string $name, string $value): self
    {
        return new self($name, $value);
    }

    /**
     * Private to enforce static factory usage.
     */
    private function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return sprintf('%s: %s', $this->name, $this->value);
    }
}
