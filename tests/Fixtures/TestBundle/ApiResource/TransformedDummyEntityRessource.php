<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Tests\Fixtures\TestBundle\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Tests\Fixtures\TestBundle\Document\TransformedDummyDocument;
use ApiPlatform\Tests\Fixtures\TestBundle\Entity\TransformedDummyEntity;

#[ApiResource(
    operations : [
        new GetCollection(uriTemplate: '/transformed_dummy_entity_ressources'),
        new Get(uriTemplate: '/transformed_dummy_entity_ressources/{id}'),
    ],
    stateOptions: new Options(
        entityClass: TransformedDummyEntity::class,
        transformEntity: [self::class, 'transformModel'],
    )
)]
class TransformedDummyEntityRessource
{
    public ?int $id = null;

    public ?int $year = null;

    public static function transformModel(TransformedDummyEntity|TransformedDummyDocument $model): self
    {
        $resource = new self();
        $resource->id = $model->getId();
        $resource->year = (int) $model->getDate()->format('Y');

        return $resource;
    }
}
