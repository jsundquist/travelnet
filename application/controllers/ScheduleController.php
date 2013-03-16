<?php

class ScheduleController extends Zend_Controller_Action
{

    private $client;

    public function init(){
        $this->client = $this->getInvokeArg('bootstrap')->getResource('twilio');
    }

    /**
     * Display a list of all the scheduled calls. We should only see the calls that have not yet been made
     */
    public function indexAction()
    {
        $callModel = new Application_Model_DbTable_Calls();

        $this->view->calls = $callModel->getUnplacedCalls();
    }

    /**
     * Add a call to our database so it can be sent off to twilio
     */
    public function addAction()
    {

        $request = $this->getRequest();

        $form = new Application_Form_Schedule();

        $this->view->form = $form;

        $contactsModel = new Application_Model_DbTable_Contacts();
        $element = $form->getElement('call_id');
        $element->addMultiOptions($contactsModel->getPairs());

        if($this->getRequest()->isPost()){
            if($form->isValid($request->getPost())){
                $callModel = new Application_Model_DbTable_Calls();
                $id = $callModel->createCall(array('caller_id' => $form->getValue('call_id')));
                $call = $this->client->account->calls->create('6123548270', '6122708838', 'http://travelnet.digital-portfolio.net/call/index?call_id=' . $id);

                $callModel->updateCall($id,
                    array(
                        'call_status' => $call->status,
                        'call_sid' => $call->sid,
                        'date_created'=>date("Y-m-d H:i:s", strtotime($call->date_created))
                    )
                );

                $this->redirect('/schedule');
            } else {
                $form->populate($form->getValues());
            }
        }
    }
}
