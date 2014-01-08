<?php

namespace Garden\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Names
 *
 * @ORM\Table(name="Names")
 * @ORM\Entity
 */
class Names
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="dutch_name", type="string", length=255, nullable=false)
	 */
	protected $dutch_name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="latin_name", type="string", length=255, nullable=false)
	 */
	protected $latin_name;

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
	 * @param string $dutch_name
	 * @return User
	 */
	public function setDutchName($dutch_name)
	{
		$this->dutch_name = $dutch_name;

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
	 * @param string $dutch_name
	 * @return User
	 */
	public function setLatinName($latin_name)
	{
		$this->latin_name = $latin_name;

		return $this;
	}

	/**
	 * Get dutch_name
	 *
	 * @return string
	 */
	public function getLatinName()
	{
		return $this->latin_name;
	}

}