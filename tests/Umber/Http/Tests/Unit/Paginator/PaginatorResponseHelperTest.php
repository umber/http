<?php

namespace Umber\Http\Tests\Unit\Paginator;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Umber\Http\Enum\HttpHeaderEnum;
use Umber\Http\Header\Collection\HttpHeaderCollection;
use Umber\Http\Pagination\PaginatorInterface;
use Umber\Http\Pagination\PaginatorResponseHelper;

/**
 * @group unit
 * 
 * @covers \Umber\Http\Pagination\PaginatorResponseHelper
 */
final class PaginatorResponseHelperTest extends TestCase
{
    /**
     * @test
     */
    public function canApplyHeaders(): void
    {
        /** @var PaginatorInterface|MockObject $paginator */
        $paginator = $this->createMock(PaginatorInterface::class);
        $paginator->expects(self::once())
            ->method('getResultPerPageCount')
            ->willReturn(1);

        $paginator->expects(self::once())
            ->method('getResultSetCount')
            ->willReturn(2);

        $paginator->expects(self::once())
            ->method('getResultTotalCount')
            ->willReturn(3);

        $paginator->expects(self::once())
            ->method('getPageTotalCount')
            ->willReturn(4);

        $headers = new HttpHeaderCollection();
        PaginatorResponseHelper::setPaginatorHeaders($paginator, $headers);

        self::assertEquals(4, $headers->count());

        $header = HttpHeaderEnum::PAGINATION_RESULTS_PER_PAGE;
        self::assertTrue($headers->has($header));
        self::assertEquals('1', $headers->get($header)->getValue());

        $header = HttpHeaderEnum::PAGINATION_RESULTS_COUNT;
        self::assertTrue($headers->has($header));
        self::assertEquals('2', $headers->get($header)->getValue());

        $header = HttpHeaderEnum::PAGINATION_RESULTS_TOTAL;
        self::assertTrue($headers->has($header));
        self::assertEquals('3', $headers->get($header)->getValue());

        $header = HttpHeaderEnum::PAGINATION_PAGES_TOTAL;
        self::assertTrue($headers->has($header));
        self::assertEquals('4', $headers->get($header)->getValue());
    }
}
