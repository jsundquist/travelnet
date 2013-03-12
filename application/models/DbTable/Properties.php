<?php
class Application_Model_DbTable_Properties extends Zend_Db_Table_Abstract
{
    protected $_name = 'properties';

    public function getProperty($id){
         $row = $this->fetchRow($id);
        if(!$row){

        }

        return $row->toArray();
    }

    public function createProperty($data){

        $this->insert($data);
    }

    public function updateProperty($id, $data){

        if(array_key_exists('id', $data)){
            $id = $data['id'];
            unset($data['id']);
        }

        $this->update($data, 'id = ' . (int)$id);
    }

    public function deleteProperty($id){
        $this->delete('id = ' . (int)$id);
    }


}