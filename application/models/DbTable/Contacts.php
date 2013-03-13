<?php

class Application_Model_DbTable_Contacts extends Zend_Db_Table_Abstract
{
    protected $_name = "contacts";

    public function getContact($id){
        $row = $this->fetchRow($id);

        if(!$row){

        }

        return $row->toArray();
    }

    public function createContact($data){
        $this->insert($data);
    }

    public function updateContact($id, $data){
        if(array_key_exists('id', $data)){
            unset($data['id']);
        }

        $this->update($data, 'id = ' . $id);
    }

    public function deleteContact($id){
        $this->delete('id = ' . $id);
    }
}
