<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Libeo.' . $_EXTKEY,
	'List',
	array(
		'Document' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Document' => 'list',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Libeo.' . $_EXTKEY,
	'Show',
	array(
		'Document' => 'show',
		
	),
	// non-cacheable actions
	array(
		'Document' => '',
		
	)
);
