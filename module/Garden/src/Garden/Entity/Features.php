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

    public function getFeature() {
        return $this->feature;
    }

}