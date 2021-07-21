<?php

namespace App\Common\Model;

interface IMapperModel
{
    public static function fromEntity(IEntity $entity): self;
}
