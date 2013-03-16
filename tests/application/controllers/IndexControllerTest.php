<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jsundquist
 * Date: 3/15/13
 * Time: 7:01 PM
 * To change this template use File | Settings | File Templates.
 */

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {
    public function setUp(){
        // Assign and instantiate in one step:
        $this->bootstrap = new Zend_Application(
            'testing',
            APPLICATION_PATH . '/configs/application.ini'
        );
        parent::setUp();
    }

    public function testIndexAction(){
        $this->dispatch('/');
        $this->assertController('index');
        $this->assertAction('index');
    }
}
