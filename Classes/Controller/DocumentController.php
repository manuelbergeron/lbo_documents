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
		$documents = $this->documentRepository->findAll()->toArray();
        foreach($documents as $i => $document) {
            $documents[$i] = $this->evaluateUrl($document);
        }

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
        $document->setSize($this->formatSizeUnits($file->getSize()));
        $document->setType($file->getExtension());

        return $document;
    }

    private function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' Gb';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' Mb';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' Kb';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bits';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' bit';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}