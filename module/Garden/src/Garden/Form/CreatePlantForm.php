<?php

namespace Garden\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class CreatePlantForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct($name);
        $this->setAttribute('method', 'post');

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'name',
            'tabindex' => 2,
            'options' => array(
                'label' => 'Naam',
                'empty_option' => 'Selecteer een plant',
            )
        ));

        $this->add(array(
            'name' => 'indigenous',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Inheems?',
            ),
        ));

        $this->add(array(
            'name' => 'height',
            'attributes' => array('type' => 'text', 'placeholder' => 'Hoogte', 'size' => '5'),
            'options' => array('label' => 'Hoogte')
        ));

        $this->add(array(
            'name' => 'origin',
            'attributes' => array('type' => 'text', 'placeholder' => 'Herkomst', 'size' => '25'),
            'options' => array('label' => 'Herkomst')
        ));

        $this->add(array(
            'name' => 'planting_date',
            'attributes' => array('type' => 'text', 'placeholder' => 'Plant datum', 'size' => '25'),
            'options' => array('label' => 'Plant datum')
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'blooming_start',
            'tabindex' => 2,
            'options' => array(
                'label' => 'Bloei start',
                'empty_option' => 'Selecteer maand',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'blooming_end',
            'tabindex' => 2,
            'options' => array(
                'label' => 'Bloei eind',
                'empty_option' => 'Selecteer maand',
            )
        ));

        $this->add(array(
            'name' => 'present',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Aanwezig?',
            ),
        ));

        $this->add(array(
            'name' => 'details',
            'attributes' => array('type' => 'textarea', 'placeholder' => 'Details', 'size' => '25'),
            'options' => array('label' => 'Details')
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'features',
            'tabindex' => 2,
            'attributes' => array(
                'multiple' => 'multiple',
            ),
            'options' => array(
                'label' => 'Kenmerken',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'habitats',
            'tabindex' => 2,
            'attributes' => array(
                'multiple' => 'multiple',
            ),
            'options' => array(
                'label' => 'Groeiplaatsen',
            )
        ));


        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }

    /*
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
     */
}