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
        $properties = new Application_Model_PropertyMapper();

        $this->view->properties = $properties->fetchAll();
    }

    /**
     * A way to add properties into our system.
     */
    public function addAction() {
        $request = $this->getRequest();

        $form = new Application_Form_Property();

        if($this->getRequest()->isPost()) {
            if($form->isValid($request->getPost())){

            }
        }

        $this->view->form = $form;
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
                var_dump($form->getValues());
                $property = new Application_Model_Property($form->getValues());
                $mapProperty = new Application_Model_PropertyMapper();
                $mapProperty->save($property);
                $this->_helper->redirect('index');
            } else {
                $form->populate($request->getPost());
            }
        } else {
            $id = $this->getParam('id',0);
            if($id > 0) {
                $property = new Application_Model_PropertyMapper();
                $form->populate($property->getProperty($id));
            }
        }

    }

    /**
     * The view action is used in case the current logged in user does not have permission to modify the properties.
     * In this case they should still be able to view the properties information.
     */
    public function viewAction() {

    }

    /**
     * The delete action will preform a "soft" delete on the property.  Since we may have call logs associated
     * to the property we do not want to lose that information. Because of this the property will just be set
     * hidden.
     *
     *
     */
    public function deleteAction() {

    }
}
