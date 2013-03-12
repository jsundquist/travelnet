<?php

class Application_Form_Property extends Zend_Form {
    public function init(){

        $this->setMethod("post");

        $this->addElement('text','name', array(
            'label' => 'Name',
            'required' => true,
            'filters' => array('StringTrim')
        ));

        $this->addElement('text','address', array(
            'label' => 'Address',
            'required' => true,
            'filters' => array('StringTrim')
        ));

        $this->addElement('text','city', array(
            'label' => 'City',
            'required' => true,
            'filters' => array('StringTrim')
        ));

        $this->addElement('text','state', array(
            'label' => 'State',
            'required' => true,
            'filters' => array('StringTrim')
        ));

        $this->addElement('text','postal_code', array(
            'label' => 'Postal Code',
            'required' => true,
            'filters' => array('StringTrim')
        ));

        $this->addElement('text','phone_number', array(
            'label' => 'Phone Number',
            'required' => true,
            'filters' => array('StringTrim')
        ));

        $this->addElement('submit','submit', array(
            'ignore' => true,
            'label' => 'Submit Property'
        ));
    }
}
