<?php

namespace Libeo\LboDocuments\Tests\Unit\Domain\Model;

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
 * Test case for class \Libeo\LboDocuments\Domain\Model\Document.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Manuel Bergeron <manuel.bergeron@libeo.com>
 */
class DocumentTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Libeo\LboDocuments\Domain\Model\Document
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Libeo\LboDocuments\Domain\Model\Document();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitreReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitre()
		);
	}

	/**
	 * @test
	 */
	public function setTitreForStringSetsTitre() {
		$this->subject->setTitre('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'titre',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLienReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getLien()
		);
	}

	/**
	 * @test
	 */
	public function setLienForFileReferenceSetsLien() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setLien($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'lien',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() {
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getContenuReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getContenu()
		);
	}

	/**
	 * @test
	 */
	public function setContenuForStringSetsContenu() {
		$this->subject->setContenu('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'contenu',
			$this->subject
		);
	}
}
