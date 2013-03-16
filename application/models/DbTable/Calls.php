<?php
class Application_Model_DbTable_Calls extends Zend_Db_Table_Abstract
{
    protected $_name = "calls";

    public function getPlacedCalls()
    {
        return $this->fetchAll('call_status <>"queued"');
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
        $row = $this->fetchRow($id);

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

    public function deleteCall($id)
    {
        return $this->delete('id = ' . $id);
    }
}