<?php

namespace Garden\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Names
 *
 * @ORM\Table(name="PlantsHabitats")
 * @ORM\Entity
 */
class PlantsHabitats {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Garden\Entity\Plants", inversedBy="habitats")
     */
    protected $plant;

    /**
     * @ORM\ManyToOne(targetEntity="Garden\Entity\Habitats")
     */
    protected $habitat;

    public function getHabitat() {
        return $this->habitat->getHabitat();
    }

    public function getHabitatId() {
        return $this->habitat->getId();
    }

    public function __construct(\Garden\Entity\Plants $plant, \Garden\Entity\Habitats $habitat) {
        $this->plant = $plant;
        $this->habitat = $habitat;
    }

}