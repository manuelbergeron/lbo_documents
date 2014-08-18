<?php
namespace Libeo\LboDocuments\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Manuel Bergeron <manuel.bergeron@libeo.com>, Libeo
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Libeo\LboDocuments\Controller\DocumentController.
 *
 * @author Manuel Bergeron <manuel.bergeron@libeo.com>
 */
class DocumentControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Libeo\LboDocuments\Controller\DocumentController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Libeo\\LboDocuments\\Controller\\DocumentController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllDocumentsFromRepositoryAndAssignsThemToView() {

		$allDocuments = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$documentRepository = $this->getMock('Libeo\\LboDocuments\\Domain\\Repository\\DocumentRepository', array('findAll'), array(), '', FALSE);
		$documentRepository->expects($this->once())->method('findAll')->will($this->returnValue($allDocuments));
		$this->inject($this->subject, 'documentRepository', $documentRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('documents', $allDocuments);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenDocumentToView() {
		$document = new \Libeo\LboDocuments\Domain\Model\Document();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('document', $document);

		$this->subject->showAction($document);
	}
}
