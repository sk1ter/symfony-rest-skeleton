<?php

namespace App\Common\Model;

class ListModel
{
    protected array $items = [];

    /**
     * ListModel constructor.
     *
     * @param IEntity[]|iterable $items
     * @param IMapperModel       $model
     */
    public function __construct(iterable $items, IMapperModel $model)
    {
        /* @var IEntity[] $items */
        foreach ($items as $item) {
            $this->items[] = $model::fromEntity($item);
        }
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
