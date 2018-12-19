<?php

declare(strict_types=1);

namespace Umber\Http\Factory;

use Umber\Http\Enum\HttpHeaderEnum;
use Umber\Http\Header\HttpHeader;
use Umber\Http\HttpResponse;
use Umber\Http\HttpResponseInterface;

use Symfony\Component\HttpFoundation\Response;

/**
 * {@inheritdoc}
 */
final class HttpResponseFactory implements HttpFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(string $type, int $status, $data): HttpResponseInterface
    {
        switch ($type) {
            case static::TYPE_JSON:
                return $this->handleJsonResponse($status, $data);
        }
    }

    /**
     * Prepare a JSON response.
     *
     * @param mixed $data
     */
    private function handleJsonResponse(int $status, $data): HttpResponseInterface
    {
        $content = '';

        // JSON encode when possible.
        if ($data !== null) {
            $content = json_encode($data);
        }

        $internal = new Response($content, $status);
        $response = new HttpResponse($internal);
        $response->setHeader(new HttpHeader(HttpHeaderEnum::CONTENT_TYPE, 'application/json'));

        return $response;
    }
}
