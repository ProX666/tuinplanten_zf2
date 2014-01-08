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

    /**
     * @ORM\OneToMany(targetEntity="Garden\Entity\PlantsFeatures", mappedBy="plant")
     */
    protected $features;

    public function addFeature(\Garden\Entity\Features $feature)
    {
        $this->features[] = $feature;
    }

    public function getFeatures()
    {
        $features = array();

        foreach ($this->features as $feature)
        {
            $features[] = $feature->getFeature();
        }
        return $features;
    }

    /**
     * @ORM\OneToMany(targetEntity="Garden\Entity\PlantsHabitats", mappedBy="plant")
     */
    protected $habitats;

    public function addHabitat(\Garden\Entity\Habitat $habitat)
    {
        $this->habitats[] = $habitat;
    }

    public function getHabitats()
    {
        $habitats = array();

        foreach ($this->habitats as $habitat)
        {
            $habitats[] = $habitat->getHabitat();
        }
        return $habitats;
    }

    /***************************************************************************
     * Public functions
     * ************************************************************************* */

    public function getId() {
        return $this->id;
    }

    public function getDutchName() {
        return $this->name->getDutchName();
    }

    public function getHeight() {
        return $this->height;
    }

    public function getIndigenous() {
        return $this->indigenous;
    }

    public function getOrigin() {
        return $this->origin;
    }

    public function getPlantingDate() {
        return $this->planting_date->format('Y-m-d');
    }

    public function getBloomingStart() {
        return $this->blooming_start;
    }

    public function getBloomingEnd() {
        return $this->blooming_end;
    }

    public function getDetails() {
        return $this->details;
    }

    public function getPresent() {
        return $this->present;
    }



    public function __construct($data) {
        $this->features = new \Doctrine\Common\Collections\ArrayCollection();
        $this->habitats = new \Doctrine\Common\Collections\ArrayCollection();

        $this->name = $data['name'];
        $this->indigenous = !empty($data['indigenous']) ? true : false;
        $this->height = !empty($data['height']) ? $data['height'] : '';   // No lastnames for Twitter, thanks...
        $this->origin = !empty($data['origin']) ? $data['origin'] : '';
        $this->planting_date = new \DateTime(date('Y-m-d H:i:s'));
        $this->blooming_start = !empty($data['blooming_start']) ? $data['blooming_start'] : '';
        $this->blooming_end = !empty($data['blooming_end']) ? $data['blooming_end'] : '';
        $this->details = !empty($data['details']) ? $data['details'] : '';
        $this->present = !empty($data['present']) ? true : false;
    }

    public function exchangeArray(array $values) {
        if (isset($values['name']))
            $this->name = $values['name'];

        if (isset($values['indigenous']))
            $this->indigenous = $values['indigenous'];

        if (isset($values['height']))
            $this->height = $values['height'];

        if (isset($values['origin']))
            $this->origin = $values['origin'];

        if (isset($values['planting_date']))
            $this->planting_date = $values['planting_date'];

        if (isset($values['blooming_start']))
            $this->blooming_start = $values['blooming_start'];

        if (isset($values['blooming_end']))
            $this->blooming_end = $values['blooming_end'];

        if (isset($values['details']))
            $this->details = $values['details'];

        if (isset($values['present']))
            $this->present = $values['present'];
    }

}