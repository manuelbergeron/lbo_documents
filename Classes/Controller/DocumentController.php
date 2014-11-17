<?php
namespace Libeo\LboDocuments\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Manuel Bergeron <manuel.bergeron@libeo.com>, Libeo
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * DocumentController
 */
class DocumentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * documentRepository
	 *
	 * @var \Libeo\LboDocuments\Domain\Repository\DocumentRepository
	 * @inject
	 */
	protected $documentRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
        $direction = \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING;

        if ($this->settings["OrderDirection"] == '2') {
            $direction = \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING;
        }

        switch ($this->settings["OrderBy"]) {
            case '2' :
                $this->documentRepository->setDefaultOrderings(array( 'crdate' => $direction));
                break;
            case '1':
            default:
                $this->documentRepository->setDefaultOrderings(array( 'uid' => $direction));
                break;
        }


		$documents = $this->documentRepository->findAll()->toArray();
        foreach($documents as $i => $document) {
            $documents[$i] = $this->evaluateUrl($document);
        }

        $this->replaceIconPath();
        $this->view->assign('settings', $this->settings);
		$this->view->assign('documents', $documents);
	}

	/**
	 * action show
	 *
	 * @param \Libeo\LboDocuments\Domain\Model\Document $document
	 * @return void
	 */
	public function showAction(\Libeo\LboDocuments\Domain\Model\Document $document) {
		$this->view->assign('document', $document);
	}

    /**
     * Évalue le liens et ajoute les informations manquantes
     * @param \Libeo\LboDocuments\Domain\Model\Document $document
     */
    private function evaluateUrl(\Libeo\LboDocuments\Domain\Model\Document $document) {
        $lien = $document->getLien();

        if (!is_a($lien, @"TYPO3\CMS\Extbase\Domain\Model\FileReference")) {
            return $document;
        }

        $file = $lien->getOriginalResource();
        $document->setFormatedFileSize($this->formatSizeUnits($file->getSize()));
        $document->setType($file->getExtension());

        return $document;
    }

    /**
     * Replace the path of the icons in the settings
     */
    private function replaceIconPath() {
        if (!isset($this->settings['type'])) {
            return;
        }

        foreach($this->settings['type'] as $i => $type) {
            if (!isset($type['icon'])) {
                continue;
            }

            if (substr($this->settings['type'][$i]['icon'], 0, 4) === 'EXT:') {
                // Get rid of 'EXT:'
                $image = substr($this->settings['type'][$i]['icon'], 4);
                list($ext, $path) = explode('/', $image, 2);
                $extRelPath = substr( \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($ext), strlen(PATH_site));
                $image = $extRelPath . $path;
                $this->settings['type'][$i]['icon'] = $image;
            }
        }
    }

    /**
     * Format the file size with the good unit for the language
     * @param $bytes
     * @return string
     */
    private function formatSizeUnits($bytes)
    {
        $gb =\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_lbodocuments_domain_model_document.filesize.gb", "lbo_documents");
        $mb =\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_lbodocuments_domain_model_document.filesize.mb", "lbo_documents");
        $kb =\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_lbodocuments_domain_model_document.filesize.kb", "lbo_documents");
        $bt =\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_lbodocuments_domain_model_document.filesize.byte", "lbo_documents");
        $bts =\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate("tx_lbodocuments_domain_model_document.filesize.bytes", "lbo_documents");
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' ' . $gb;
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' ' . $mb;
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' ' . $kb;
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' ' .$bts;
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' ' . $bt;
        } else {
            $bytes = '0 ' . $bt;
        }

        return $bytes;
    }
}