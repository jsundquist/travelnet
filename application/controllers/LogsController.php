<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jsundquist
 * Date: 3/8/13
 * Time: 7:59 PM
 * To change this template use File | Settings | File Templates.
 */
class LogsController extends Zend_Controller_Action {

    private $client;
    /**
     *
     */
    public function init(){
        $this->view->controller = "logs";
        $this->client = $this->getInvokeArg('bootstrap')->getResource('twilio');

    }

    public function indexAction() {
        $callsModel = new Application_Model_DbTable_Calls();

        $this->view->calls = $callsModel->getPlacedCalls();
    }

    public function viewAction() {
        $id = $this->getParam('id', 0);
        if($id === 0){
            $this->redirect('/logs');
        }

        $callsModel = new Application_Model_DbTable_Calls();

        $this->view->caller = $callsModel->getCall($id);
    }
}