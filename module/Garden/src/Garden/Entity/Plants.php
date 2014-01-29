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
     * @ORM\ManyToOne(targetEntity="Garden\Entity\Names")
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
     * @var boolean $deleted
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    protected $deleted;

    /**
     * @ORM\OneToMany(targetEntity="Garden\Entity\PlantsFeatures", mappedBy="plant")
     */
    protected $features;

    public function addPlantsFeature(\Garden\Entity\PlantsFeatures $feature) {
        $this->features[] = $feature;
    }

    public function getFeatureIds() {
        $features = array();

        foreach ($this->features as $feature) {
            $features[] = $feature->getFeatureId();
        }
        return $features;
    }

    public function getFeatures() {
        $features = array();

        foreach ($this->features as $feature) {
            $features[] = $feature->getFeature();
        }
        return $features;
    }

    /**
     * @ORM\OneToMany(targetEntity="Garden\Entity\PlantsHabitats", mappedBy="plant")
     */
    protected $habitats;

    public function addPlantsHabitat(\Garden\Entity\PlantsHabitats $habitat) {
        $this->habitats[] = $habitat;
    }

    public function getHabitats() {
        $habitats = array();

        foreach ($this->habitats as $habitat) {
            $habitats[] = $habitat->getHabitat();
        }
        return $habitats;
    }

    public function getHabitatIds() {
        $habitats = array();

        foreach ($this->habitats as $habitat) {
            $habitats[] = $habitat->getHabitatId();
        }
        return $habitats;
    }

    public function getFirstPhoto() {

    }

    /*     * *************************************************************************
     * Public functions
     * ************************************************************************* */

    public function getId() {
        return $this->id;
    }

    public function getDutchName() {
        return $this->name->getDutchName();
    }

    public function getLatinName() {
        return $this->name->getLatinName();
    }

    public function getNameId() {
        return $this->name->getId();
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
        return $this->planting_date->format('d-m-Y');
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

    public function getDeleted() {
        return $this->deleted;
    }


    // setters
     public function setName($name) {
        $this->name = $name;
    }

    public function setIndigenous($indigenous) {
        $this->indigenous = $indigenous;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function setOrigin($origin) {
        $this->origin = $origin;
    }

    public function setPlantingDate($planting_date) {
        $this->planting_date = $planting_date;
    }

    public function setPresent($present) {
        $this->present = $present;
    }

    public function setDetails($details) {
        $this->details = $details;
    }

     public function setBloomingStart($blooming_start) {
        $this->blooming_start = $blooming_start;
    }

     public function setBloomingEnd($blooming_end) {
        $this->blooming_end = $blooming_end;
    }

    public function setDeleted() {
        $this->deleted = true;
    }

     public function setFeatures($features) {
        $this->features = $features;
    }

    public function setHabitats($habitats) {
        $this->habitats = $habitats;
    }


    /**
    *
    */
    public function __construct() {
        $this->features = new \Doctrine\Common\Collections\ArrayCollection();
        $this->habitats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setPlant($data) {
        $this->name = $data['name'];
        $this->indigenous = !empty($data['indigenous']) ? true : false;
        $this->height = !empty($data['height']) ? $data['height'] : '';
        $this->origin = !empty($data['origin']) ? $data['origin'] : '';
        $this->planting_date = new \DateTime(date('Y-m-d H:i:s'));
        $this->blooming_start = !empty($data['blooming_start']) ? $data['blooming_start'] : '';
        $this->blooming_end = !empty($data['blooming_end']) ? $data['blooming_end'] : '';
        $this->details = !empty($data['details']) ? $data['details'] : '';
        $this->present = !empty($data['present']) ? true : false;
        $this->deleted = false;
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
            $this->planting_date = new \DateTime(date($values['planting_date']));

        if (isset($values['blooming_start']))
            $this->blooming_start = $values['blooming_start'];

        if (isset($values['blooming_end']))
            $this->blooming_end = $values['blooming_end'];

        if (isset($values['details']))
            $this->details = $values['details'];

        if (isset($values['present']))
            $this->present = $values['present'];

    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() {
        return get_object_vars($this);
    }

}