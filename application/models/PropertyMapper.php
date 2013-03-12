<?php
class Application_Model_PropertyMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Guestbook');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Property $property)
    {
        $data = array(
            'name'   => $property->getName(),
            'address' => $property->getAddress(),
            'city' => $property->getCity(),
            'state' => $property->getState(),
            'postal_code' => $property->getPostalCode(),
            'phone_number' => $property->getPhoneNumber(),
            'created' => date('Y-m-d H:i:s'),
        );

        if (null === ($id = $property->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Property $property)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $property->setId($row->id)
            ->setName($row->email)
            ->setAddress($row->address)
            ->setCity($row->city)
            ->setState($row->state)
            ->setPostalCode($row->post_code)
            ->setPhoneNumber($row->phone_number)
            ->setCreated($row->created);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Property();
            $entry->setId($row->id)
                ->setName($row->email)
                ->setAddress($row->address)
                ->setCity($row->city)
                ->setState($row->state)
                ->setPostalCode($row->post_code)
                ->setPhoneNumber($row->phone_number)
                ->setCreated($row->created);
            $entries[] = $entry;
        }
        return $entries;
    }
}