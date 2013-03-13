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
     * A listing of all contacts currently within the system
     */
    public function indexAction(){
        $contacts = new Application_Model_DbTable_Contacts();

        $this->view->contacts = $contacts->fetchAll();
    }

    /**
     * A way to add contacts into our system.
     */
    public function addAction() {
        $request = $this->getRequest();

        $form = new Application_Form_Contact();

        $this->view->form = $form;

        if($this->getRequest()->isPost()) {
            if($form->isValid($request->getPost())){
                $property = new Application_Model_DbTable_Contacts();
                $property->createContact($form->getValues());
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
        $form = new Application_Form_Contact();

        $this->view->form = $form;

        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $property = new Application_Model_DbTable_Contacts();

                $property->updateContact($form->getValue('id'), $form->getValues());
                $this->_helper->redirector('index');

            } else {
                $form->populate($request->getPost());
            }
        } else {
            $id = $this->getParam('id',0);
            if($id > 0) {
                $property = new Application_Model_DbTable_Contacts();
                $form->populate($property->getContact($id));
            }
        }

    }

    /**
     * The view action is used in case the current logged in user does not have permission to modify the contacts.
     * In this case they should still be able to view the contacts information.
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
        $id = $this->getParam('id', 0);
        if($id >0){
            $property = new Application_Model_DbTable_Contacts();
            $property->deleteContact($id);
        }

        $this->_helper->redirector('index');
    }
}
