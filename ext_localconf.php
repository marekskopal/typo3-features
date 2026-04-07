<?php

declare(strict_types=1);

use MarekSkopal\MsFeatures\Controller\FeatureController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
    'MsFeatures',
    'Feature',
    [FeatureController::class => 'list'],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
);
