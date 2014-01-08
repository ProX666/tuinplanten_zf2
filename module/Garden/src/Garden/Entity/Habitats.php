<?php

namespace Garden\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Habitats
 *
 * @ORM\Table(name="Habitats")
 * @ORM\Entity
 */
class Habitats
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
	 * @var string $habitat
	 *
	 * @ORM\Column(name="habitat", type="string", length=255, nullable=false)
	 */
	protected $habitat;
}