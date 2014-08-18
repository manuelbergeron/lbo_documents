<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'List',
	'Liste de documents'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Show',
	'Détail document texte'
);

$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$listPluginSignature = strtolower($extensionName) . '_list';

$showPluginSignature = strtolower($extensionName) . '_show';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'lbo_documents');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_lbodocuments_domain_model_document', 'EXT:lbo_documents/Resources/Private/Language/locallang_csh_tx_lbodocuments_domain_model_document.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_lbodocuments_domain_model_document');
$GLOBALS['TCA']['tx_lbodocuments_domain_model_document'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:lbo_documents/Resources/Private/Language/locallang_db.xlf:tx_lbodocuments_domain_model_document',
		'label' => 'titre',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'titre,lien,description,contenu,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Document.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_lbodocuments_domain_model_document.gif'
	),
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$listPluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($listPluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$showPluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($showPluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_show.xml');