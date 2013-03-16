<?php
class Application_Form_Schedule extends Zend_Form  {
    public function init(){

        $this->setMethod('post');

        $this->addElement('hidden', 'id', array(
            'ignore' => true,
            'filters' => array('Int')
        ));

        $this->addElement('select', 'call_id', array(
            'label' => 'Who should we call?',
            'required'=> true,
            'filters' => array('Int')
        ));

        $this->addElement('submit','submit', array(
            'ignore' => true,
            'label' => 'Submit'
        ));
    }
}