<?php

namespace Garden\Form;

use Zend\Form\Form;
use Zend\Form\Element\File;

class PhotoForm extends Form {

    private $_id;
    private $inputFilter;

    /**
     *
     * @param int $id   : plant id for which the upload takes place
     */
    public function __construct($id, $name = null) {
        parent::__construct($name);
        $this->setAttribute('method', 'post');
        $this->_id = $id;
        $this->init();
    }

    public function init() {

        // create select input for title
        $this->add(array(
            'name' => 'title',
            'attributes' => array('type' => 'text', 'placeholder' => 'Titel'),
            'options' => array('label' => 'Titel')
        ));

        // create textarea input for description
        $this->add(array(
            'name' => 'description',
            'attributes' => array('type' => 'textarea', 'placeholder' => 'Description', 'size' => '25'),
            'options' => array('label' => 'Description')
        ));

        // create file input
        $file = new File('fileupload');
        $file->setLabel('Foto Upload')
                ->setAttribute('id', 'fileupload');
        $this->add($file);

        // create submit button
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new \Zend\InputFilter\InputFilter();
            $factory = new \Zend\InputFilter\Factory();

            $inputFilter->add(
                    $factory->createInput(array(
                        'name' => 'title',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
                    ))
            );

            $inputFilter->add(
                    $factory->createInput(array(
                        'name' => 'description',
                        'required' => false,
                    ))
            );

            $inputFilter->add(
                    $factory->createInput(array(
                        'name' => 'fileupload',
                        'required' => true,
                    ))
            );

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}