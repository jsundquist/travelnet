<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jsundquist
 * Date: 3/15/13
 * Time: 6:47 PM
 * To change this template use File | Settings | File Templates.
 */

class PropertiesControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {

    public function setUp(){
        // Assign and instantiate in one step:
        $this->bootstrap = new Zend_Application(
            'testing',
            APPLICATION_PATH . '/configs/application.ini'
        );
        parent::setUp();
    }

    public function testIndexAction(){
        $this->dispatch('/properties');
        $this->assertController('properties');
        $this->assertAction('index');
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

        $this->dispatch('/properties/add');
        $this->assertController('properties');
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

        $this->dispatch('/properties/add');
        $this->assertController('properties');
        $this->assertAction('add');
    }

    public function testGetEditPage()
    {
        $this->request->setQuery(array(
            'id' => 1
        ));
        $this->dispatch('/properties/edit');
        $this->assertController('properties');
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

        $this->dispatch('/properties/edit');
        $this->assertController('properties');
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

        $this->dispatch('/properties/edit');
        $this->assertController('properties');
        $this->assertAction('edit');
    }


    public function testGetDeletePage()
    {

        $this->request->setQuery(array(
            'id' => 1
        ));
        $this->dispatch('/properties/delete');
        $this->assertController('properties');
        $this->assertAction('delete');
    }
}
