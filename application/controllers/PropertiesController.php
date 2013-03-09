<?php
/**
 *
 */
class PropertiesController extends Zend_Controller_Action {

    /**
     * A listing of all properties currently within the system
     */
    public function indexAction(){

    }

    /**
     * A way to add properties into our system.
     */
    public function addAction() {

    }

    /**
     * The edit action is used in case a mistake is found within a specific property.  Since the property information
     * will be relaid to potential clients/customers we need to make sure we have everything up to date.
     */
    public function editAction() {

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