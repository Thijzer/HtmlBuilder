<?php

namespace Html\Functions;

/**
 * Interface for PagerFanta (esc) Pagination
 */
interface PaginationInterface
{
    /** returns the all the items */
    public function getCurrentPageResults(): array;
    /** Found enough pages to paginate */
    public function haveToPaginate(): bool;
    public function getCurrentPage(): int;
    public function getPreviousPage(): int;
    /** returns the page amount */
    public function getNbPages(): int;
}