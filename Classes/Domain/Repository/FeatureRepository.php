<?php

declare(strict_types=1);

namespace MarekSkopal\MsFeatures\Domain\Repository;

use MarekSkopal\MsFeatures\Domain\Model\Feature;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/** @extends Repository<Feature> */
class FeatureRepository extends Repository
{
    /** @return QueryResultInterface<int, Feature> */
    public function findAllOrdered(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->setOrderings([
            'top' => QueryInterface::ORDER_DESCENDING,
            'sorting' => QueryInterface::ORDER_ASCENDING,
        ]);
        return $query->execute();
    }

    /** @return QueryResultInterface<int, Feature> */
    public function findAllOrderedBySorting(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->setOrderings(['sorting' => QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }

    /** @return QueryResultInterface<int, Feature> */
    public function findAllOrderedByUid(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->setOrderings(['uid' => QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }

    /** @return QueryResultInterface<int, Feature> */
    public function findAllOrderedAlphabetically(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->setOrderings(['title' => QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }

    /** @return QueryResultInterface<int, Feature> */
    public function findAllOrderedTopOnly(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching($query->equals('top', true));
        $query->setOrderings([
            'top' => QueryInterface::ORDER_DESCENDING,
            'sorting' => QueryInterface::ORDER_ASCENDING,
        ]);
        return $query->execute();
    }

    /** @return QueryResultInterface<int, Feature> */
    public function findAllOrderedTopOnlyBySorting(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching($query->equals('top', true));
        $query->setOrderings(['sorting' => QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }

    /** @return QueryResultInterface<int, Feature> */
    public function findAllOrderedTopOnlyByUid(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching($query->equals('top', true));
        $query->setOrderings(['uid' => QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }

    /** @return QueryResultInterface<int, Feature> */
    public function findAllOrderedTopOnlyAlphabetically(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching($query->equals('top', true));
        $query->setOrderings(['title' => QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }
}
