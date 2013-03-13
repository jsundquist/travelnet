<?php
class Application_Model_DbTable_Calls extends Zend_Db_Table_Abstract
{
    protected $_name = "calls";

    public function getPlacedCalls()
    {
        return $this->fetchAll();
    }

    public function getUnplacedCalls()
    {
        return $this->fetchAll();
    }

    public function getCall($id)
    {
        $row = $this->fetchRow($id);

        if (!$row) {

        }

        return $row->toArray();
    }

    public function createCall($data)
    {
        $this->insert($data);
    }

    public function updateCall($id, $data)
    {

        if (array_key_exists('id', $data)) {
            unset($data['id']);
        }

        $this->update($data, 'id = ' . $id);
    }

    public function deleteCall($id)
    {
        $this->delete('id = ' . $id);
    }
}