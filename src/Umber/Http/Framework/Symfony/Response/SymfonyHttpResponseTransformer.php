<?php

declare(strict_types=1);

namespace Umber\Http\Framework\Symfony\Response;

use Umber\Http\Response\HttpResponseInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Handle the transformation of Http Responses to Symfony Responses.
 */
final class SymfonyHttpResponseTransformer
{
    /**
     * Handle transformation.
     */
    public function transform(HttpResponseInterface $response, Request $request): Response
    {
        $headers = [];

        foreach ($response->getHeaders()->all() as $header) {
            $name = $header->getName();

            $headers[$name] = $header->getValue();
        }

        $symfony = new Response(
            $response->getBody(),
            $response->getStatusCode(),
            $headers
        );

        return $symfony;
    }
}
