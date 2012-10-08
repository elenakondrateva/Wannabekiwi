<?php

require_once 'CommonController.php';

class IndexController extends CommonController
{

    public function indexAction()
    {
    	$filter = 'favourite';
    	
    	$where = array('is_favourite=?' => '1');
    	$order_by = 'date DESC';
    	
    	$request = $this->getRequest();
    	if (isset($request->all)) {
    		$where = array();
    		$filter = 'all';
    	}
    	
        $mapper = new Application_Model_PostsMapper();
        $posts = $mapper->fetchAll($where, $order_by);
        $this->view->posts = $posts;
        $this->view->filter = $filter;
    }

}







