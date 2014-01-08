<?php

namespace Garden\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uploads
 *
 * @ORM\Table(name="Uploads")
 * @ORM\Entity
 */
class Uploads {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Garden\Entity\Plants")
     */
    protected $plant;

    /**
	 * @var string $title
	 *
	 * @ORM\Column(name="title", type="string", length=255, nullable=false)
	 */
	protected $title;

     /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
	 * @var string $filename
	 *
	 * @ORM\Column(name="filename", type="string", length=255, nullable=false)
	 */
	protected $filename;

      /**
     * @var integer $filesize
     *
     * @ORM\Column(name="filesize", type="integer", length=11)
     */
    protected $filesize;

     /**
	 * @var string $filemime
	 *
	 * @ORM\Column(name="filemime", type="string", length=45, nullable=false)
	 */
	protected $filemime;

      /**
     * @var boolean $selected
     *
     * @ORM\Column(name="selected", type="boolean")
     */
    protected $selected;

    
}