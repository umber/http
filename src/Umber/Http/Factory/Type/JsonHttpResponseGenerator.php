<?php

declare(strict_types=1);

namespace Umber\Http\Factory\Type;

use Umber\Http\Enum\HttpStatusEnum;
use Umber\Http\Response\HttpResponseInterface;
use Umber\Http\Serializer\HttpResponseSerializerInterface;
use Umber\Http\Serializer\Response\SerializerHttpResponse;

/**
 * A JSON HTTP Response generator for common tasks.
 *
 * This class represents a few common use cases that are needed for my purpose but
 * also should serve as a good example of how to implement your own. Feel free to
 * use composition and wrap this class with your own helpers.
 */
final class JsonHttpResponseGenerator
{
    /** @var JsonHttpResponseFactoryInterface */
    private $factory;

    /** @var HttpResponseSerializerInterface|null */
    private $serializer;

    public function __construct(JsonHttpResponseFactoryInterface $factory, ?HttpResponseSerializerInterface $serializer = null)
    {
        $this->factory = $factory;
        $this->serializer = $serializer;
    }

    /**
     * Generate a HTTP response.
     *
     * @param mixed $data
     * @param string[] $groups
     */
    public function generate(int $status, $data, array $groups = []): HttpResponseInterface
    {
        $response = $this->factory->create($status, $data);

        if ($this->serializer !== null) {
            $response = new SerializerHttpResponse($response, $this->serializer, $groups);
        }

        return $response;
    }

    /**
     * Generate a response with HTTP Status: 200 OK.
     *
     * @see HttpStatusEnum::OK
     *
     * @param mixed $data
     * @param string[] $groups
     */
    public function ok($data, array $groups = []): HttpResponseInterface
    {
        return $this->generate(HttpStatusEnum::OK, $data, $groups);
    }

    /**
     * Generate a response with HTTP Status: 201 CREATED.
     *
     * @see HttpStatusEnum::CREATED
     *
     * @param mixed $data
     * @param string[] $groups
     */
    public function created($data, array $groups = []): HttpResponseInterface
    {
        return $this->generate(HttpStatusEnum::CREATED, $data, $groups);
    }

    /**
     * Generate a response with HTTP Status: 202 ACCEPTED.
     *
     * @see HttpStatusEnum::ACCEPTED
     *
     * @param mixed $data
     * @param string[] $groups
     */
    public function accepted($data, array $groups = []): HttpResponseInterface
    {
        return $this->generate(HttpStatusEnum::ACCEPTED, $data, $groups);
    }

    /**
     * Generate a response with HTTP Status: 204 NO CONTENT.
     *
     * @see HttpStatusEnum::NO_CONTENT
     */
    public function noContent(): HttpResponseInterface
    {
        return $this->generate(HttpStatusEnum::NO_CONTENT, '');
    }

    /**
     * Generate a response with HTTP Status: 400 BAD REQUEST.
     *
     * @see HttpStatusEnum::BAD_REQUEST
     *
     * @param mixed $data
     * @param string[] $groups
     */
    public function badRequest($data, array $groups = []): HttpResponseInterface
    {
        return $this->generate(HttpStatusEnum::BAD_REQUEST, $data, $groups);
    }

    /**
     * Generate a response with HTTP Status: 404 NOT FOUND.
     *
     * @see HttpStatusEnum::NOT_FOUND
     *
     * @param mixed $data
     * @param string[] $groups
     */
    public function notFound($data, array $groups = []): HttpResponseInterface
    {
        return $this->generate(HttpStatusEnum::NOT_FOUND, $data, $groups);
    }

    /**
     * Generate a response with HTTP Status: 406 NOT ACCEPTABLE.
     *
     * @see HttpStatusEnum::NOT_ACCEPTABLE
     *
     * @param mixed $data
     * @param string[] $groups
     */
    public function notAcceptable($data, array $groups = []): HttpResponseInterface
    {
        return $this->generate(HttpStatusEnum::NOT_ACCEPTABLE, $data, $groups);
    }

    /**
     * Generate a response with HTTP Status: 409 CONFLICT.
     *
     * @see HttpStatusEnum::CONFLICT
     *
     * @param mixed $data
     * @param string[] $groups
     */
    public function conflict($data, array $groups = []): HttpResponseInterface
    {
        return $this->generate(HttpStatusEnum::CONFLICT, $data, $groups);
    }

    /**
     * Generate a response with HTTP Status: 422 UNPROCESSABLE ENTITY.
     *
     * @see HttpStatusEnum::UNPROCESSABLE_ENTITY
     *
     * @param mixed $data
     * @param string[] $groups
     */
    public function unprocessableEntity($data, array $groups = []): HttpResponseInterface
    {
        return $this->generate(HttpStatusEnum::UNPROCESSABLE_ENTITY, $data, $groups);
    }
}
