<?php
/**
 *
 */
class PropertiesController extends Zend_Controller_Action {

    /**
     *
     */
    public function init(){
        $this->view->controller = "properties";
    }

    /**
     * A listing of all properties currently within the system
     */
    public function indexAction(){
        $properties = new Application_Model_DbTable_Properties();

        $this->view->properties = $properties->fetchAll();
    }

    /**
     * A way to add properties into our system.
     */
    public function addAction() {
        $request = $this->getRequest();

        $form = new Application_Form_Property();

        $this->view->form = $form;

        if($this->getRequest()->isPost()) {
            if($form->isValid($request->getPost())){
                $property = new Application_Model_DbTable_Properties();
                $property->createProperty($form->getValues());
                $this->_helper->redirector('index');
            } else {
                $form->populate($form->getValues());
            }
        }
    }

    /**
     * The edit action is used in case a mistake is found within a specific property.  Since the property information
     * will be relaid to potential clients/customers we need to make sure we have everything up to date.
     */
    public function editAction() {
        $request = $this->getRequest();
        $form = new Application_Form_Property();

        $this->view->form = $form;

        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $property = new Application_Model_DbTable_Properties();

                $property->updateProperty($form->getValue('id'), $form->getValues());
                $this->_helper->redirector('index');

            } else {
                $form->populate($request->getPost());
            }
        } else {
            $id = $this->getParam('id',0);
            if($id > 0) {
                $property = new Application_Model_DbTable_Properties();
                $form->populate($property->getProperty($id));
            }
        }

    }

    /**
     * The delete action will preform a "soft" delete on the property.  Since we may have call logs associated
     * to the property we do not want to lose that information. Because of this the property will just be set
     * hidden.
     *
     *
     */
    public function deleteAction() {
        $id = $this->getParam('id', 0);
        if($id >0){
            $property = new Application_Model_DbTable_Properties();
            $property->deleteProperty($id);
        }
        
        $this->_helper->redirector('index');
    }
}
