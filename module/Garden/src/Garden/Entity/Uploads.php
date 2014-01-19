<?php

namespace Garden\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uploads
 *
 * @ORM\Table(name="Uploads")
 * @ORM\Entity
 */
class Uploads {

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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    protected $title;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string $filename
     *
     * @ORM\Column(name="filename", type="string", length=255, nullable=false)
     */
    protected $filename;

    /**
     * @var integer $filesize
     *
     * @ORM\Column(name="filesize", type="integer", length=11)
     */
    protected $filesize;

    /**
     * @var string $filemime
     *
     * @ORM\Column(name="filemime", type="string", length=45, nullable=false)
     */
    protected $filemime;

    /**
     * @var boolean $selected
     *
     * @ORM\Column(name="selected", type="boolean", nullable=true)
     */
    protected $selected;

    public function setSelected($bool) {
        $this->selected = $bool;
    }

    public function __construct($plant) {
        $this->plant = $plant;
        $this->selected = true;
    }

    public function exchangeArray(array $values) {
        if (isset($values['title']))
            $this->title = $values['title'];

        if (isset($values['description']))
            $this->description = $values['description'];

        if (isset($values['fileupload']['name']))
            $this->filename = $values['fileupload']['name'];

        if (isset($values['fileupload']['size']))
            $this->filesize = $values['fileupload']['size'];

        if (isset($values['fileupload']['type']))
            $this->filemime = $values['fileupload']['type'];
    }


    public function getFirstPhoto($id) {
        if (!empty($id)) {

            $uploads = $this->_table->fetchAll(
                            $this->_table->select()
                                    ->from(array('u' => 'uploads'), array('title', 'description', 'filename'))
                                    ->where('selected = 1')
                                    ->where('plant_id = ?', $id)
                    )->toArray();

            if (!empty($uploads)) {
                return $uploads[0];
            } else {
                return false;
            }
        }
    }

    public function displayAllPhotos($id) {
        if (!empty($id)) {
            $uploads = $this->_table->fetchAll(
                            $this->_table->select()
                                    ->from(array('u' => 'uploads'), array('id', 'title', 'description', 'filename'))
                                    ->where('plant_id = ?', $id)
                    )->toArray();

            return $uploads;
        }
    }

}