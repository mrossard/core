<?php

namespace ApiPlatform\Tests\Fixtures\TestBundle\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Tests\Fixtures\TestBundle\Entity\HumanReadableIdEntity;
use ApiPlatform\Tests\Fixtures\TestBundle\State\HumanReadableIdMapper;

#[ApiResource(
    operations     : [
        new Get(
            uriTemplate : '/resourceWithBusinessId/{businessId}',
            uriVariables: ['businessId']
        ),
        new Put(
            uriTemplate: '/withReadableId/{businessId}',
            allowCreate: true
        ),
    ],
    stateOptions   : new Options(entityClass: HumanReadableIdEntity::class, mapper: new HumanReadableIdMapper()),
    extraProperties: ['standard_put' => true,]
)]
class HumanReadableIdResource
{
    #[ApiProperty(identifier: true)]
    public ?string $businessId;

    public ?string $name;
}
