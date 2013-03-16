<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jsundquist
 * Date: 3/16/13
 * Time: 2:20 PM
 * To change this template use File | Settings | File Templates.
 */

class ScheduleControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {

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

    public function testIndexAction(){
        $this->dispatch('/schedule');
        $this->assertController('schedule');
        $this->assertAction('index');
    }

    public function testAddAction(){
        $this->dispatch('/schedule/add');
        $this->assertController('schedule');
        $this->assertAction('add');
    }

    public function testValidAdAction(){

        $this->request->setMethod('POST')
            ->setPost(array(
                'call_id' => 18
            ));
        $this->dispatch('/schedule/add');
        $this->assertController('schedule');
        $this->assertAction('add');
    }

    public function testInValidAddAction(){
        $this->request->setMethod('POST')
            ->setPost(array(
                'call_id' => ''
            ));

        $this->dispatch('/schedule/add');
        $this->assertController('schedule');
        $this->assertAction('add');
    }

}
