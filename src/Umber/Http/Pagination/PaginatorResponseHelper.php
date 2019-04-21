<?php

declare(strict_types=1);

namespace Umber\Http\Pagination;

use Umber\Http\Enum\HttpHeaderEnum;
use Umber\Http\Header\Collection\HttpHeaderCollection;
use Umber\Http\Header\HttpHeader;

/**
 * A helper for working with responses and paginator's.
 */
final class PaginatorResponseHelper
{
    /**
     * Set pagination headers.
     */
    public static function setPaginatorHeaders(PaginatorInterface $paginator, HttpHeaderCollection $headers): void
    {
        $headers->add(
            HttpHeader::create(
                HttpHeaderEnum::PAGINATION_RESULTS_PER_PAGE,
                (string) $paginator->getResultPerPageCount()
            )
        );

        $headers->add(
            HttpHeader::create(
                HttpHeaderEnum::PAGINATION_RESULTS_COUNT,
                (string) $paginator->getResultSetCount()
            )
        );

        $headers->add(
            HttpHeader::create(
                HttpHeaderEnum::PAGINATION_RESULTS_TOTAL,
                (string) $paginator->getResultTotalCount()
            )
        );

        $headers->add(
            HttpHeader::create(
                HttpHeaderEnum::PAGINATION_PAGES_TOTAL,
                (string) $paginator->getPageTotalCount()
            )
        );
    }
}
