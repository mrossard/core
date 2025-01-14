<?php

namespace ApiPlatform\Tests\Fixtures\TestBundle\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Tests\Fixtures\TestBundle\Entity\TransformedDummyEntity;

#[ApiResource(
    operations :[
        new GetCollection(),
        new Get(),
    ],
    stateOptions: new Options(
        entityClass: TransformedDummyEntity::class,
        transformEntity: [self::class, 'transformEntity'],
    )
)]
class TransformedDummyRessource
{
    public ?int $id = null;

    public ?int $year = null;

    public static function transformEntity(TransformedDummyEntity $entity): self
    {
        $resource = new self();
        $resource->id = $entity->getId();
        $resource->year = (int) $entity->getDate()->format('Y');

        return $resource;
    }

}
