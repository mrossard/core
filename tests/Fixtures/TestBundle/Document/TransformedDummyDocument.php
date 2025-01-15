<?php

namespace ApiPlatform\Tests\Fixtures\TestBundle\Document;

use Doctrine\DBAL\Types\Types;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[  ODM\Document]
class TransformedDummyDocument
{

    #[ODM\Id(type: 'int', strategy: 'INCREMENT')]
    private ?int $id = null;

    #[ODM\Field(type: 'date_immutable')]
    private \DateTimeInterface $date;

    public function __construct(\DateTimeInterface $date = null)
    {
        $this->setDate($date ?? new \DateTimeImmutable());
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): void
    {
        $this->date = $date;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

}
