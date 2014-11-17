<?php
namespace Libeo\LboDocuments\Domain\Model;


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
 * Document
 */
class Document extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    /**
     * @var DateTime
     */
    protected $crdate;

    /**
     * @var DateTime
     */
    protected $tstamp;

    /**
     * @var DateTime
     */
    protected $starttime;

    /**
     * @var DateTime
     */
    protected $endtime;


    /**
     * formatedFileSize
     * @var string
     */
    protected $formatedFileSize;

    /**
	 * titre
	 *
	 * @var string
	 */
	protected $titre = '';

	/**
	 * lien
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $lien = NULL;

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * contenu
	 *
	 * @var string
	 */
	protected $contenu = '';

    /**
     * size
     *
     * @var string
     */
    protected $size = '';

    /**
     * type
     *
     * @var string
     */
    protected $type = '';


    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

	/**
	 * Returns the titre
	 *
	 * @return string $titre
	 */
	public function getTitre() {
		return $this->titre;
	}

	/**
	 * Sets the titre
	 *
	 * @param string $titre
	 * @return void
	 */
	public function setTitre($titre) {
		$this->titre = $titre;
	}

	/**
	 * Returns the lien
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $lien
	 */
	public function getLien() {
		return $this->lien;
	}

	/**
	 * Sets the lien
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $lien
	 * @return void
	 */
	public function setLien(\TYPO3\CMS\Extbase\Domain\Model\FileReference $lien) {
		$this->lien = $lien;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the contenu
	 *
	 * @return string $contenu
	 */
	public function getContenu() {
		return $this->contenu;
	}

	/**
	 * Sets the contenu
	 *
	 * @param string $contenu
	 * @return void
	 */
	public function setContenu($contenu) {
		$this->contenu = $contenu;
	}

    /**
     * Get creation date
     *
     * @return integer
     */
    public function getCrdate() {
        return $this->crdate;
    }

    /**
     * Set creation date
     *
     * @param integer $crdate
     * @return void
     */
    public function setCrdate($crdate) {
        $this->crdate = $crdate;
    }

    /**
     * Get year of crdate
     *
     * @return integer
     */
    public function getYearOfCrdate() {
        return $this->getCrdate()->format('Y');
    }

    /**
     * Get month of crdate
     *
     * @return integer
     */
    public function getMonthOfCrdate() {
        return $this->getCrdate()->format('m');
    }

    /**
     * Get day of crdate
     *
     * @return integer
     */
    public function getDayOfCrdate() {
        return (int)$this->crdate->format('d');
    }

    /**
     * Get timestamp
     *
     * @return integer
     */
    public function getTstamp() {
        return $this->tstamp;
    }

    /**
     * Set time stamp
     *
     * @param integer $tstamp time stamp
     * @return void
     */
    public function setTstamp($tstamp) {
        $this->tstamp = $tstamp;
    }

    /**
    * Get start time
    *
    * @return DateTime
    */
    public function getStarttime() {
        return $this->starttime;
    }

    /**
     * Set start time
     *
     * @param integer $starttime start time
     * @return void
     */
    public function setStarttime($starttime) {
        $this->starttime = $starttime;
    }

    /**
     * Get year of starttime
     *
     * @return integer
     */
    public function getYearOfStarttime() {
        return $this->getStarttime()->format('Y');
    }

    /**
     * Get month of starttime
     *
     * @return integer
     */
    public function getMonthOfStarttime() {
        return $this->getStarttime()->format('m');
    }

    /**
     * Get day of starttime
     *
     * @return integer
     */
    public function getDayOfStarttime() {
        return (int)$this->starttime->format('d');
    }

    /**
     * Get endtime
     *
     * @return DateTime
     */
    public function getEndtime() {
        return $this->endtime;
    }

    /**
     * Set end time
     *
     * @param integer $endtime end time
     * @return void
     */
    public function setEndtime($endtime) {
        $this->endtime = $endtime;
    }

    /**
     * Get year of endtime
     *
     * @return integer
     */
    public function getYearOfEndtime() {
        return $this->getEndtime()->format('Y');
    }

    /**
     * Get month of endtime
     *
     * @return integer
     */
    public function getMonthOfEndtime() {
        return $this->getEndtime()->format('m');
    }

    /**
     * Get day of endtime
     *
     * @return integer
     */
    public function getDayOfEndtime() {
        return (int)$this->endtime->format('d');
    }

    /**
     * Get formatedFileSize
     * @return string
     */
    public function getFormatedFileSize() {
        return $this->formatedFileSize;
    }

    /**
     * Set formatedFileSize
     * @param string $formatedFileSize
     */
    public function setFormatedFileSize($formatedFileSize) {
        $this->formatedFileSize = $formatedFileSize;
    }

}