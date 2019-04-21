<?php

declare(strict_types=1);

namespace Umber\Http\Response\Hint;

use Umber\Http\Pagination\PaginatorInterface;

interface PaginatorAwareHttpResponseInterface
{
    /**
     * Return the paginator.
     */
    public function getPaginator(): PaginatorInterface;
}
