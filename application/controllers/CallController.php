<?php
/**
 *
 */
class CallController extends Zend_Controller_Action
{

    /**
     * @var Service_Twitter
     */
    private $client;

    private $callModel;

    public function init()
    {
        $this->_helper->layout()->disableLayout();
        $this->getResponse()->setHeader('Content-Type', 'text/xml');

        $this->client = $this->getInvokeArg('bootstrap')->getResource('twilio');

        $this->callModel = new Application_Model_DbTable_Calls();

        if($this->getRequest()->isPost()){
            $callId = $this->getParam('call_id', 0);

            if($callId > 0){
                // Get an object from its sid. If you do not have a sid,
                // check out the list resource examples on this page
                $callSid = $this->getParam('CallSid', 0);
                $call = $this->client->account->calls->get($callSid);

                $callStatus = $call->recordings->client->last_response->status;
                $this->callModel->updateCall($callId, array('call_status' => $callStatus));
            }

        }
    }

    /**
     * Initial call. Find out if they booked or not
     */
    public function indexAction()
    {
        $digits = $this->getParam('Digits', 0);


        $this->view->callId = $callId = $this->getParam('call_id', 0);

        if ($digits) {

            switch ($digits) {
                case 1:
                    $this->callModel->updateCall($callId, array('booked' => 1));
                    $this->redirect('/call/booked?call_id=' . $callId);
                    break;
                case 2:
                    $this->callModel->updateCall($callId, array('booked' => 0));
                    $this->redirect('/call/noBooking?call_id=' . $callId);
                    break;
            }
        }
    }

    /**
     *
     */
    public function bookedAction()
    {
        $digits = $this->getParam('Digits', 0);
        $this->view->callId = $callId = $this->getParam('call_id', 0);

        if ($digits && $digits <= 5) {
            $this->callModel->updateCall($callId, array('rating' => $digits));

            $this->redirect('/call/recommend?call_id=' . $callId);
        }
    }

    public function recommendAction()
    {
        $digits = $this->getParam('Digits', 0);
        $this->view->callId = $callId = $this->getParam('call_id', 0);

        if ($digits) {
            $this->callModel->updateCall($callId, array('recommend' => $digits - 1));

            $this->redirect('/call/otherproperties?call_id=' . $callId);
        }
    }

    /**
     *
     */
    public function nobookingAction()
    {
        $digits = $this->getParam('Digits', 0);
        $this->view->callId = $callId = $this->getParam('call_id', 0);

        $reasonsModel = new Application_Model_DbTable_Reasons();
        $this->view->reasons = $reasonsModel->fetchAll();

        if ($digits) {
            $this->callModel->updateCall($callId, array('reason' => $digits));
            $this->redirect('/call/otherproperties?call_id=' . $callId);
        }
    }

    /**
     *
     */
    public function otherpropertiesAction()
    {
        $digits = $this->getParam('Digits', 0);
        $this->view->callId = $callId = $this->getParam('call_id', 0);

        if ($digits) {
            switch ($digits) {
                case 1:
                    $this->redirect('/call/properties?call_id=' . $callId);
                    break;
                case 2:
                    $this->redirect('/call/goodbye?call_id=' . $callId);
                    break;
            }
        }
    }

    public function propertiesAction(){
        $digits = $this->getParam('Digits', 0);
        $this->view->callId = $callId = $this->getParam('call_id', 0);

        $property = new Application_Model_DbTable_Properties();
        $this->view->properties = $property->fetchAll(null, null, 3);
    }

    /**
     *
     */
    public function connectAction()
    {
        $digits = $this->getParam('Digits', 0);
        $callId = $this->getParam('call_id', 0);
    }

    /**
     *
     */
    public function goodbyeAction()
    {
    }
}
