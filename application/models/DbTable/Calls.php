<?php
class Application_Model_DbTable_Calls extends Zend_Db_Table_Abstract
{
    protected $_name = "calls";

    public function getPlacedCalls()
    {
        $select = $this->select();
        $select->setIntegrityCheck(false);

        $select->from($this->_name, array('calls.id', 'calls.call_status', 'calls.date_created'))->join('contacts', 'contacts.id = calls.caller_id', array('contacts.name','contacts.phone_number'))->where('call_status <>"queued"');

        return $this->fetchAll($select);
    }

    public function getUnplacedCalls()
    {
        $select = $this->select();
        $select->setIntegrityCheck(false);

        $select->from($this->_name, array('calls.id', 'calls.call_status', 'calls.date_created'))->join('contacts', 'contacts.id = calls.caller_id', array('contacts.name','contacts.phone_number'))->where('call_status = "queued"');

        return $this->fetchAll($select);
    }

    public function getCall($id)
    {
        $select = $this->select();

        $select->setIntegrityCheck(false);

        $callTable = array('id','booked','rating','recommend','reason','call_status','date_created','date_updated');

        $contactTable = array('name','address','city','state','postal_code','phone_number');
        $select->from($this->_name, $callTable)
                ->join('contacts', 'contacts.id = calls.caller_id',$contactTable)
                ->joinLeft('no_booking_reasons', 'no_booking_reasons.id = calls.reason', array('no_booking_reasons.reason'))
                ->where('calls.id = ' . $id);

        $row = $this->fetchRow($select);

        if(!$row){
            return array();
        }

        return $row->toArray();
    }

    public function createCall($data)
    {
        return $this->insert($data);
    }

    public function updateCall($id, $data)
    {
        return $this->update($data, 'id = ' . $id);
    }
}