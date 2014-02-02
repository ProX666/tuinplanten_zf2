<?php
namespace Garden\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class CreateFeatureForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct($name);
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'feature',
            'attributes' => array('type' => 'text', 'placeholder' => 'Geef nieuw kenmerk', 'size' => '25'),
        ));

       /* $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));*/
    }

    public function getInputFilter() {
        if (!$this->filter) {
            $this->filter = new InputFilter();
            $factory = new \Zend\InputFilter\Factory();
            $this->filter->add($factory->createInput(array(
                        'name' => 'feature',
                        'required' => true,
            )));
        }
        return $this->filter;
    }

}