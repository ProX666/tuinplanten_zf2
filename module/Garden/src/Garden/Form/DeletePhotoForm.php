<?php

namespace Garden\Form;

use Zend\Form\Form;

class DeletePhotoForm extends Form {

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

        // create radio buttons for first photo selection
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'deletePhoto',
            'attributes' => array('class' => 'firstPhoto'),
            'options' => array(
                'label' => 'Selecteer de te verwijderen foto(s)',
                'value_options' => array(
                ),
            )
        ));

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
                        'name' => 'deletePhoto',
                        'required' => false,
                    ))
            );

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}