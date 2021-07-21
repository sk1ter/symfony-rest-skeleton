<?php

namespace App\Common\Model;

use Knp\Component\Pager\Pagination\PaginationInterface;

class PageableModel extends ListModel
{
    private PaginationMetaModel $pagination;

    public function __construct(PaginationInterface $pagination, IMapperModel $model)
    {
        parent::__construct($pagination->getItems(), $model);

        $this->pagination = new PaginationMetaModel($pagination);
    }

    /**
     * @return PaginationMetaModel
     */
    public function getPagination(): PaginationMetaModel
    {
        return $this->pagination;
    }
}
