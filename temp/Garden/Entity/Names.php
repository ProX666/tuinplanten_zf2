<?php

namespace Garden\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Names
 */
class Names
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $dutch_name;

    /**
     * @var string
     */
    private $latin_name;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dutch_name
     *
     * @param string $dutchName
     * @return Names
     */
    public function setDutchName($dutchName)
    {
        $this->dutch_name = $dutchName;

        return $this;
    }

    /**
     * Get dutch_name
     *
     * @return string 
     */
    public function getDutchName()
    {
        return $this->dutch_name;
    }

    /**
     * Set latin_name
     *
     * @param string $latinName
     * @return Names
     */
    public function setLatinName($latinName)
    {
        $this->latin_name = $latinName;

        return $this;
    }

    /**
     * Get latin_name
     *
     * @return string 
     */
    public function getLatinName()
    {
        return $this->latin_name;
    }
}
