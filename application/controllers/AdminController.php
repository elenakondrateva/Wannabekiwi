<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
    	$auth = Zend_Auth::getInstance();
    	if (!$auth->hasIdentity()) {
    		return $this->_helper->redirector('auth', 'index');
    	}
    	$this->view->user = $auth->getIdentity();
    	
    	$this->_helper->layout->setLayout('admin');
    }

    public function indexAction()
    {
        $mapper = new Application_Model_PostsMapper();
        $posts = $mapper->fetchAll($where, $order_by);
        $this->view->posts = $posts;
    }


}

