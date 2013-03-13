<?php
/**
 *
 */
class CallController extends Zend_Controller_Action {

    public function init(){
        $this->_helper->layout()->disableLayout();
        $this->getResponse()->setHeader('Content-Type', 'text/xml');
    }
    
    /**
     *
     */
    public function indexAction() {
    }

    public function step2Action(){
        $response = $this->getParam('Digits', 0);
        
        switch($response){
            case 1:
                $this->_helper->redirector('enjoyed');
                break;
            case 2:
                $this->_helper->redirector('didntEnjoy');
                break;
            case 3:
                $this->_helper->redirector('noVisit');
                break;
        }
    }

    public function enjoyedAction(){
    }

    public function didntEnjoyAction(){}

    public function noVisitAction(){}

    public function recommendAction(){
        $this->_helper->redirector('otherProperties');
    }

    public function otherPropertiesAction(){
        $this->_helper->redirector('thankYou');
    }

    public function thankYouAction(){}
}
