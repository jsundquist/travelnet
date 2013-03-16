<?php

class ScheduleController extends Zend_Controller_Action
{

    /**
     * Display a list of all the scheduled calls. We should only see the calls that have not yet been made
     */
    public function indexAction()
    {

    }

    /**
     * Add a call to our database so it can be sent off to twilio
     */
    public function addAction()
    {
        $AccountSid = 'AC6a91408d4993b7d6bee3efa15d19f80d';
        $AuthToken = 'd861f6128265464d0830f8b8bb28a366';

        $client = new Services_Twilio($AccountSid, $AuthToken);

        $callModel = new Application_Model_DbTable_Calls();
        $id = $callModel->insert(array('scheduled' => 1));

        $call = $client->account->calls->create('6123548270', '6122708838', 'http://travelnet.digital-portfolio.net/call/index?call_id=0');
    }

    /**
     * Edit a call.  This will only be allowed if twilio has not yet made the call.
     */
    public function editAction()
    {

    }

    /**
     * View the information about the call
     */
    public function viewAction()
    {

    }

    /**
     * Delete the call. Only allowed if the call has not yet been placed by twilio.
     */
    public function deleteAction()
    {

    }
}
