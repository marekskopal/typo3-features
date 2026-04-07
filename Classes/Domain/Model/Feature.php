<?php

declare(strict_types=1);

namespace MarekSkopal\MsFeatures\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Feature extends AbstractEntity
{
    protected string $title = '';

    protected string $subtitle = '';

    protected string $perex = '';

    protected string $description = '';

    /** @var ObjectStorage<FileReference> */
    protected ObjectStorage $images;

    protected bool $top = false;

    public function __construct()
    {
        $this->images = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function getPerex(): string
    {
        return $this->perex;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /** @return ObjectStorage<FileReference> */
    public function getImages(): ObjectStorage
    {
        return $this->images;
    }

    public function getMainImage(): ?FileReference
    {
        foreach ($this->images as $image) {
            return $image;
        }
        return null;
    }

    public function isTop(): bool
    {
        return $this->top;
    }
}
