<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jsundquist
 * Date: 3/8/13
 * Time: 7:59 PM
 * To change this template use File | Settings | File Templates.
 */
class LogsController extends Zend_Controller_Action {

    /**
     *
     */
    public function init(){
        $this->view->controller = "logs";
    }

    public function indexAction() {
        $callsModel = new Application_Model_DbTable_Calls();

        $this->view->calls = $callsModel->fetchAll();
    }

    public function viewAction() {

    }
}