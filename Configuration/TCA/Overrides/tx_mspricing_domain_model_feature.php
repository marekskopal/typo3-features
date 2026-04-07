<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die;

if (ExtensionManagementUtility::isLoaded('ms_pricing')) {
    $llPath = 'LLL:EXT:ms_features/Resources/Private/Language/locallang_db.xlf';

    $columns = [
        'ms_features_feature' => [
            'label' => $llPath . ':tx_mspricing_domain_model_feature.ms_features_feature',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_msfeatures_domain_model_feature',
                'foreign_table_where' => 'ORDER BY tx_msfeatures_domain_model_feature.title ASC',
                'items' => [
                    ['label' => $llPath . ':tx_mspricing_domain_model_feature.ms_features_feature.none', 'value' => 0],
                ],
                'default' => 0,
            ],
        ],
    ];

    ExtensionManagementUtility::addTCAcolumns('tx_mspricing_domain_model_feature', $columns);
    ExtensionManagementUtility::addToAllTCAtypes('tx_mspricing_domain_model_feature', 'ms_features_feature', '', 'after:description');
}
