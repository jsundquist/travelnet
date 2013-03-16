<?php
/**
 *
 */
class CallController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout()->disableLayout();
        $this->getResponse()->setHeader('Content-Type', 'text/xml');
    }

    /**
     * Initial call. Find out if they booked or not
     */
    public function indexAction()
    {
        $digits = $this->getParam('Digits', 0);
        $callId = $this->getParam('call_id', 0);

        if ($digits) {
            $call = new Application_Model_DbTable_Calls();

            switch ($digits) {
                case 1:
                    $call->updateCall($callId, array('booked' => 1));
                    $this->redirect('booked?call_id=' . $callId);
                    break;
                case 2:
                    $call->updateCall($callId, array('booked' => 0));
                    $this->redirect('noBooking?call_id=' . $callId);
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
        $callId = $this->getParam('call_id', 0);

        if ($digits && $digits <= 5) {
            $call = new Application_Model_DbTable_Calls();
            $call->updateCall($callId, array('rating' => $digits));

            $this->redirect('recommend?call_id=' . $callId);
        }
    }

    public function recommendAction()
    {
        $digits = $this->getParam('Digits', 0);
        $callId = $this->getParam('call_id', 0);

        if ($digits) {
            $call = new Application_Model_DbTable_Calls();
            $call->updateCall($callId, array('recommend' => $digits - 1));

            $this->redirect('otherProperties?call_id=' . $callId);
        }
    }

    /**
     *
     */
    public function nobookingAction()
    {
        $digits = $this->getParam('Digits', 0);
        $callId = $this->getParam('call_id', 0);

        if ($digits) {
            $call = new Application_Model_DbTable_Calls();
            $call->updateCall($callId, array('reason' => $digits));
            $this->redirect('otherProperties?call_id=' . $callId);
        }
    }

    /**
     *
     */
    public function otherpropertiesAction()
    {
        $digits = $this->getParam('Digits', 0);
        $callId = $this->getParam('call_id', 0);

        if ($digits) {
            switch ($digits) {
                case 1:
                    $this->redirect('otherProperties?call_id=' . $callId);
                    break;
                case 2:
                    $this->redirect('goodBye?call_id=' . $callId);
                    break;
            }
            $call = new Application_Model_DbTable_Calls();
            $call->updateCall($callId, array('rating' => $digits));


        }
    }

    public function propertiesAction(){
        $digits = $this->getParam('Digits', 0);
        $callId = $this->getParam('call_id', 0);

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
