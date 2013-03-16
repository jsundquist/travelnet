<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jsundquist
 * Date: 3/15/13
 * Time: 6:11 PM
 * To change this template use File | Settings | File Templates.
 */

class CallControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {
    public function setUp()
    {
        // Assign and instantiate in one step:
        $this->bootstrap = new Zend_Application(
            'testing',
            APPLICATION_PATH . '/configs/application.ini'
        );
        parent::setUp();
    }

    public function testGetIndexAction(){

        $this->dispatch('/call');
        $this->assertController('call');
        $this->assertAction('index');
    }

    public function testBookedIndexAction(){
        $this->request->setQuery(array(
            'Digits' => 1,
            'call_id' => 1
        ));

        $this->dispatch('/call');
        $this->assertController('call');
        $this->assertAction('index');
    }

    public function testNoBookingIndexAction(){
        $this->request->setQuery(array(
            'Digits' => 2,
            'call_id' => 1
        ));

        $this->dispatch('/call');
        $this->assertController('call');
        $this->assertAction('index');
    }

    public function testBookedAction(){

        $this->request->setQuery(array(
            'Digits' => 2,
            'call_id' => 1
        ));

        $this->dispatch('/call/booked');
        $this->assertController('call');
        $this->assertAction('booked');
    }

    public function testRecommendAction(){
        $this->request->setQuery(array(
            'Digits' => 2,
            'call_id' => 1
        ));

        $this->dispatch('/call/recommend');
        $this->assertController('call');
        $this->assertAction('recommend');
    }

    public function testNoBookingAction(){
        $this->request->setQuery(array(
            'Digits' => 2,
            'call_id' => 1
        ));

        $this->dispatch('/call/nobooking');
        $this->assertController('call');
        $this->assertAction('nobooking');
    }

    public function testOtherPropertiesAction(){
        $this->request->setQuery(array(
            'Digits' => 1,
            'call_id' => 1
        ));

        $this->dispatch('/call/otherproperties');
        $this->assertController('call');
        $this->assertAction('otherproperties');
    }

    public function testNoOtherPropertiesAction(){
        $this->request->setQuery(array(
            'Digits' => 2,
            'call_id' => 1
        ));

        $this->dispatch('/call/otherproperties');
        $this->assertController('call');
        $this->assertAction('otherproperties');
    }

    public function testConnectionAction(){
        $this->request->setQuery(array(
            'Digits' => 2,
            'call_id' => 1
        ));

        $this->dispatch('/call/connect');
        $this->assertController('call');
        $this->assertAction('connect');
    }

    public function testGoodByeAction(){
        $this->dispatch('/call/goodbye');
        $this->assertController('call');
        $this->assertAction('goodbye');
    }

    public function testPropertiesAction(){
        $this->dispatch('/call/properties');
        $this->assertController('call');
        $this->assertAction('properties');
    }
}
