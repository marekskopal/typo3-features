<?php

declare(strict_types=1);

namespace MarekSkopal\MsFeatures\Tests\Unit\Domain\Model;

use MarekSkopal\MsFeatures\Domain\Model\Feature;
use PHPUnit\Framework\TestCase;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

final class FeatureTest extends TestCase
{
    private Feature $feature;

    protected function setUp(): void
    {
        $this->feature = new Feature();
    }

    public function testTitleDefaultsToEmptyString(): void
    {
        self::assertSame('', $this->feature->getTitle());
    }

    public function testSubtitleDefaultsToEmptyString(): void
    {
        self::assertSame('', $this->feature->getSubtitle());
    }

    public function testPerexDefaultsToEmptyString(): void
    {
        self::assertSame('', $this->feature->getPerex());
    }

    public function testDescriptionDefaultsToEmptyString(): void
    {
        self::assertSame('', $this->feature->getDescription());
    }

    public function testTopDefaultsToFalse(): void
    {
        self::assertFalse($this->feature->isTop());
    }

    public function testImagesDefaultsToEmptyObjectStorage(): void
    {
        self::assertInstanceOf(ObjectStorage::class, $this->feature->getImages());
        self::assertSame(0, $this->feature->getImages()->count());
    }

    public function testGetMainImageReturnsNullWhenNoImages(): void
    {
        self::assertNull($this->feature->getMainImage());
    }

    public function testGetMainImageReturnsFirstImage(): void
    {
        $fileReference = $this->createMock(FileReference::class);
        $storage = new ObjectStorage();
        $storage->attach($fileReference);

        $this->feature->_setProperty('images', $storage);

        self::assertSame($fileReference, $this->feature->getMainImage());
    }
}
