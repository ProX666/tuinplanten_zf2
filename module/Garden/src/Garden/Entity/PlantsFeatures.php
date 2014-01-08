<?php

namespace Garden\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Names
 *
 * @ORM\Table(name="PlantsFeatures")
 * @ORM\Entity
 */
class PlantsFeatures {

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
     * @ORM\ManyToOne(targetEntity="Garden\Entity\Features")
     */
    protected $feature;

}