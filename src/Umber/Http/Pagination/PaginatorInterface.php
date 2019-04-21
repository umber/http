<?php

declare(strict_types=1);

namespace Umber\Http\Pagination;

use Countable;
use IteratorAggregate;
use Traversable;

/**
 * A basic paginator representation.
 */
interface PaginatorInterface extends Traversable, Countable, IteratorAggregate
{
    /**
     * Return the current page.
     */
    public function getCurrentPageNumber(): int;

    /**
     * Return the count of items in the current page.
     */
    public function getResultSetCount(): int;

    /**
     * Return the count of items in the entire result set.
     */
    public function getResultTotalCount(): int;

    /**
     * Return the maximum count of items to return for a page.
     */
    public function getResultPerPageCount(): int;

    /**
     * Return the count of pages that cover the result set.
     */
    public function getPageTotalCount(): int;

    /**
     * Return all the data in the page.
     *
     * @return mixed[]
     */
    public function getPageData(): array;
}
