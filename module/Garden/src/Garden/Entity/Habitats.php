<?php

namespace Garden\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Habitats
 *
 * @ORM\Table(name="Habitats")
 * @ORM\Entity
 */
class Habitats {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string $habitat
     *
     * @ORM\Column(name="habitat", type="string", length=255, nullable=false)
     */
    protected $habitat;

    public function getHabitat() {
        return $this->habitat;
    }

    public function getId() {
        return $this->id;
    }

    public function setHabitat($habitat) {
        $this->habitat = $habitat;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

     public function exchangeArray(array $values)
    {
        if (isset($values['habitat']))
            $this->setHabitat($values['habitat']);
    }


}