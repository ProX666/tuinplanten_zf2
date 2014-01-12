<?php

namespace Garden\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Features
 *
 * @ORM\Table(name="Features")
 * @ORM\Entity
 */
class Features {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string $feature
     *
     * @ORM\Column(name="feature", type="string", length=255, nullable=false)
     */
    protected $feature;

    public function __construct() {
    }

    public function getFeature() {
        return $this->feature;
    }

    public function setFeature($feature) {
        $this->feature = $feature;
    }

    public function getId() {
        return $this->id;
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
        if (isset($values['feature']))
            $this->setFeature($values['feature']);
    }

}