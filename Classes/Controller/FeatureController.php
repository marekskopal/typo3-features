<?php

declare(strict_types=1);

namespace MarekSkopal\MsFeatures\Controller;

use MarekSkopal\MsFeatures\Domain\Repository\FeatureRepository;
use Psr\Http\Message\ResponseInterface;

class FeatureController extends ActionController
{
    public function __construct(private readonly FeatureRepository $featureRepository)
    {
    }

    public function listAction(): ResponseInterface
    {
        /**
         * @var array{
         *     filter?: string,
         *     ordering?: string,
         *  } $settings
         */
        $settings = $this->settings;

        $filter = $settings['filter'] ?? 'all';
        $ordering = $settings['ordering'] ?? 'topSorting';
        $showOnlyTop = $filter === 'onlyTopped';

        $features = match (true) {
            $showOnlyTop && $ordering === 'sorting' => $this->featureRepository->findAllOrderedTopOnlyBySorting(),
            $showOnlyTop && $ordering === 'uid' => $this->featureRepository->findAllOrderedTopOnlyByUid(),
            $showOnlyTop && $ordering === 'alphabetically' => $this->featureRepository->findAllOrderedTopOnlyAlphabetically(),
            $showOnlyTop => $this->featureRepository->findAllOrderedTopOnly(),
            $ordering === 'sorting' => $this->featureRepository->findAllOrderedBySorting(),
            $ordering === 'uid' => $this->featureRepository->findAllOrderedByUid(),
            $ordering === 'alphabetically' => $this->featureRepository->findAllOrderedAlphabetically(),
            default => $this->featureRepository->findAllOrdered(),
        };

        $this->view->assign('features', $features);

        return $this->htmlResponse();
    }
}
