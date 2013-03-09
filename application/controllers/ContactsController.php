<?php
/**
 *
 */
class ContactsController extends Zend_Controller_Action {

    /**
     *
     */
    public function init(){
        $this->view->controller = "contacts";
    }

    /**
     *
     */
    public function indexAction(){

    }

    /**
     *
     */
    public function addAction(){

    }

    /**
     *
     */
    public function editAction(){

    }

    /**
     *
     */
    public function deleteAction(){
        //Disable the view so no error is thrown
        $this->_helper->viewRenderer->setNoRender(true);
    }
}