<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jsundquist
 * Date: 3/14/13
 * Time: 8:46 PM
 * To change this template use File | Settings | File Templates.
 */

class ContactsControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {
    public $_form;

    public function setUp()
    {
        // Assign and instantiate in one step:
        $this->bootstrap = new Zend_Application(
            'testing',
            APPLICATION_PATH . '/configs/application.ini'
        );
        parent::setUp();
    }

    public function testGetIndexPage()
    {
        $this->dispatch('/contacts');
        $this->assertController('contacts');
        $this->assertAction('index');
    }

    public function testGetAddPage()
    {
        $this->dispatch('/contacts/add');
        $this->assertController('contacts');
        $this->assertAction('add');
    }

    public function testPostAddPage()
    {

        $this->request->setMethod('POST')
            ->setPost(array(
                'name' => 'test',
                'address' => 'test',
                'city' => 'test',
                'state' => 'test',
                'postal_code' => 'test',
                'phone_number' => 'test'
            ));

        $this->dispatch('/contacts/add');
        $this->assertController('contacts');
        $this->assertAction('add');

    }

    public function testPostInvalidAddPage(){
        $this->request->setMethod('POST')
            ->setPost(array(
                'name' => 'test',
                'address' => 'test',
                'city' => 'test',
                'state' => 'test',
                'postal_code' => 'test'
            ));

        $this->dispatch('/contacts/add');
        $this->assertController('contacts');
        $this->assertAction('add');
    }

    public function testGetEditPage()
    {
        $this->request->setQuery(array(
            'id' => 1
        ));
        $this->dispatch('/contacts/edit');
        $this->assertController('contacts');
        $this->assertAction('edit');


        $this->_form = new Application_Form_Contact();
    }

    public function testPostEditPage()
    {

        $this->request->setMethod('POST')
            ->setPost(array(
                'name' => 'test',
                'address' => 'test',
                'city' => 'test',
                'state' => 'test',
                'postal_code' => 'test',
                'phone_number' => 'test'
            ));

        $this->dispatch('/contacts/edit');
        $this->assertController('contacts');
        $this->assertAction('edit');

    }

    public function testPostInvalidEditPage(){
        $this->request->setMethod('POST')
            ->setPost(array(
                'name' => 'test',
                'address' => 'test',
                'city' => 'test',
                'state' => 'test',
                'postal_code' => 'test'
            ));

        $this->dispatch('/contacts/edit');
        $this->assertController('contacts');
        $this->assertAction('edit');
    }

    public function testGetDeletePage()
    {

        $this->request->setQuery(array(
            'id' => 1
        ));
        $this->dispatch('/contacts/delete');
        $this->assertController('contacts');
        $this->assertAction('delete');
    }
}
