<?php

namespace ApiPlatform\Tests\Fixtures\TestBundle\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Tests\Fixtures\TestBundle\Document\TransformedDummyDocument;
use ApiPlatform\Tests\Fixtures\TestBundle\Entity\TransformedDummyEntity;

#[ApiResource(
    operations :[
        new GetCollection(uriTemplate: '/transformed_dummy_document_ressources'),
        new Get(uriTemplate: '/transformed_dummy_document_ressources/{id}'),
    ],
    stateOptions: new \ApiPlatform\Doctrine\Odm\State\Options(
        documentClass: TransformedDummyDocument::class,
        transformDocument: [self::class, 'transformModel'],
    )
)]
class TransformedDummyDocumentRessource
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
