<?php

namespace App\Common\Data;

use Doctrine\ORM\Query;
use App\Common\Model\IMapperModel;
use App\Common\Model\PageableModel;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Pageable
{
    private int $limit = 20;
    private PaginatorInterface $paginator;
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack, PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
        $this->requestStack = $requestStack;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function create(Query $query, IMapperModel $model): PageableModel
    {
        $paginate = $this->paginator->paginate(
            $query,
            $this->requestStack->getCurrentRequest()->query->getInt('page', 1),
            $this->limit
        );

        return new PageableModel($paginate, $model);
    }
}
