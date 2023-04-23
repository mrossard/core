<?php

namespace ApiPlatform\Doctrine\Orm\State;

interface ResourceMapperInterface
{
    public function entityToResource($entity): object;

    public function resourceToEntity($resource): object;
}