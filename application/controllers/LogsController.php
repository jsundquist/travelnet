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

        $this->view->calls = $callsModel->fetchAll();

//        $call = $this->client->account->calls->get('CA91dc28209f8bf2fcfba87e6916c78a9f');
//        var_dump($call);die();

    }

    public function viewAction() {

    }
}