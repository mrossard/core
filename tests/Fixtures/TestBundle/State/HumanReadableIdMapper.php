<?php

namespace ApiPlatform\Tests\Fixtures\TestBundle\State;

use ApiPlatform\Doctrine\Orm\State\ResourceMapperInterface;
use ApiPlatform\Tests\Fixtures\TestBundle\ApiResource\HumanReadableIdResource;
use ApiPlatform\Tests\Fixtures\TestBundle\Entity\HumanReadableIdEntity;

class HumanReadableIdMapper implements ResourceMapperInterface
{

    /**
     * @param HumanReadableIdEntity $entity
     * @return HumanReadableIdResource
     */
    public function entityToResource($entity): object
    {
        $resource = new HumanReadableIdResource();
        $resource->name = $entity->getName();
        $resource->businessId = $entity->getBusinessId();
        return $resource;
    }

    /**
     * @param HumanReadableIdResource $resource
     * @return HumanReadableIdEntity
     */
    public function resourceToEntity($resource): object
    {
        $entity = new HumanReadableIdEntity();
        $entity->setName($resource->name);
        $entity->setBusinessId($resource->businessId);
        return $entity;
    }
}