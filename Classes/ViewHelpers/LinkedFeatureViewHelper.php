<?php

declare(strict_types=1);

namespace MarekSkopal\MsFeatures\ViewHelpers;

use Doctrine\DBAL\ParameterType;
use MarekSkopal\MsFeatures\Domain\Model\Feature;
use MarekSkopal\MsFeatures\Domain\Repository\FeatureRepository;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class LinkedFeatureViewHelper extends AbstractViewHelper
{
    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     * @var bool
     */
    protected $escapeOutput = false;

    public function __construct(private readonly FeatureRepository $featureRepository, private readonly ConnectionPool $connectionPool,)
    {
    }

    public function initializeArguments(): void
    {
        $this->registerArgument('pricingFeatureUid', 'int', 'UID of the pricing feature record', true);
        $this->registerArgument('as', 'string', 'Variable name for the linked feature', false, 'linkedFeature');
    }

    public function render(): string
    {
        $rawUid = $this->arguments['pricingFeatureUid'];
        $pricingFeatureUid = is_int($rawUid) ? $rawUid : (is_scalar($rawUid) ? (int) $rawUid : 0);
        $as = is_string($this->arguments['as']) ? $this->arguments['as'] : 'linkedFeature';

        $linkedFeature = $this->resolveLinkedFeature($pricingFeatureUid);

        if ($this->renderingContext === null) {
            return '';
        }

        $variableProvider = $this->renderingContext->getVariableProvider();
        $variableProvider->add($as, $linkedFeature);
        $content = $this->renderChildren();
        $variableProvider->remove($as);

        return is_string($content) ? $content : '';
    }

    private function resolveLinkedFeature(int $pricingFeatureUid): ?Feature
    {
        if ($pricingFeatureUid <= 0) {
            return null;
        }

        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('tx_mspricing_domain_model_feature');
        $row = $queryBuilder
            ->select('ms_features_feature')
            ->from('tx_mspricing_domain_model_feature')
            ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($pricingFeatureUid, ParameterType::INTEGER)))
            ->executeQuery()
            ->fetchAssociative();

        if ($row === false) {
            return null;
        }

        $rawFeatureUid = $row['ms_features_feature'];
        $msFeatureUid = is_int($rawFeatureUid) ? $rawFeatureUid : (is_scalar($rawFeatureUid) ? (int) $rawFeatureUid : 0);

        if ($msFeatureUid === 0) {
            return null;
        }

        $feature = $this->featureRepository->findByUid($msFeatureUid);

        return $feature instanceof Feature ? $feature : null;
    }
}
