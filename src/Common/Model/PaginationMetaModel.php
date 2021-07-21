<?php

namespace App\Common\Model;

use Knp\Component\Pager\Pagination\PaginationInterface;

class PaginationMetaModel
{
    private int $count;
    private int $current_page_number;
    private int $item_number_per_page;
    private int $total_item_count;

    public function __construct(PaginationInterface $pagination)
    {
        $this->count = $pagination->count();
        $this->current_page_number = $pagination->getCurrentPageNumber();
        $this->item_number_per_page = $pagination->getItemNumberPerPage();
        $this->total_item_count = $pagination->getTotalItemCount();
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getCurrentPageNumber(): int
    {
        return $this->current_page_number;
    }

    public function getItemNumberPerPage(): int
    {
        return $this->item_number_per_page;
    }

    public function getTotalItemCount(): int
    {
        return $this->total_item_count;
    }
}
