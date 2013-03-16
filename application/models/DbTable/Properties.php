<?php
class Application_Model_DbTable_Properties extends Zend_Db_Table_Abstract
{
    protected $_name = 'properties';

    public function getProperty($id){
         $row = $this->fetchRow($id);

        if(!$row){
            return array();
        }

        return $row->toArray();
    }

    public function createProperty($data){

        $this->insert($data);
    }

    public function updateProperty($id, $data){

        $this->update($data, 'id = ' . (int)$id);
    }

    public function deleteProperty($id){
        $this->delete('id = ' . (int)$id);
    }


}