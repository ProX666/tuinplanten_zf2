<?php

namespace Garden\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Names
 *
 * @ORM\Table(name="Plants")
 * @ORM\Entity
 */
class Plants {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Garden\Entity\Names")
     */
    protected $name;

    /**
     * @var boolean $indigenous
     *
     * @ORM\Column(name="indigenous", type="boolean")
     */
    protected $indigenous;


      /**
     * @var integer $height
     *
     * @ORM\Column(name="height", type="integer", length=2)
     */
    protected $height;

    /**
     * @var text $origin
     *
     * @ORM\Column(name="origin", type="text", nullable=true)
     */
    protected $origin;

      /**
     * @var \DateTime
     *
     * @ORM\Column(name="planting_date", type="datetime", nullable=true)
     */
    protected $planting_date;

      /**
     * @var integer $blooming_start
     *
     * @ORM\Column(name="blooming_start", type="integer", length=20)
     */
    protected $blooming_start;

  /**
     * @var integer $blooming_end
     *
     * @ORM\Column(name="blooming_end", type="integer", length=20)
     */
    protected $blooming_end;

     /**
     * @var text $details
     *
     * @ORM\Column(name="details", type="text", nullable=true)
     */
    protected $details;

     /**
     * @var boolean $present
     *
     * @ORM\Column(name="present", type="boolean")
     */
    protected $present;


}