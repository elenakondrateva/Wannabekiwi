<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
    	$auth = Zend_Auth::getInstance();
    	if (!$auth->hasIdentity()) {
    		return $this->_helper->redirector('index', 'auth');
    	}
    	$this->view->user = $auth->getIdentity();
    	
    	$this->_helper->layout->setLayout('admin');
    }

    public function indexAction()
    {
    	$request = $this->getRequest();
    	$where = array();
    	if (isset($request->search)) { //FIXME: temporary, only for assigment
    		$search_text = strip_tags($request->search);
    		$where[] = "title LIKE '%".$search_text."%' OR text LIKE '%".$search_text."%' OR author LIKE '%".$search_text."%'";
    	
    		$this->view->search_text = $search_text;
    	}    	
    	
        $mapper = new Application_Model_PostsMapper();
        $posts = $mapper->fetchAll($where);
        $this->view->posts = $posts;
    }

    public function posteditAction()
    {
    	$request = $this->getRequest();
    	if ($request->post_id) {
    		$post = new Application_Model_Posts();
    		$mapper = new Application_Model_PostsMapper();
    		$mapper->find($request->post_id, $post);
    		 
    		$form = new Application_Form_Post(array('post'=>$post));
    		
    		if ($request->isPost()) {
    			if ($form->isValid($request->getPost())) {
    				$data = $form->getValues();
    		
    				$post = new Application_Model_Posts($data);
    				$mapper->save($post);
    				return $this->_helper->redirector('index');
    			}
    		}
    		
    		$this->view->form = $form;
    	}
    }

    public function postdeleteAction()
    {
        $request = $this->getRequest();
    	if ($request->post_id) {
    		$post = new Application_Model_Posts();
    		$mapper = new Application_Model_PostsMapper();
    		
    		if ($request->delete) {
    			$db = Zend_Db_Table::getDefaultAdapter();
    			$where = $db->quoteInto('id = ?', $request->post_id);
    			$db->delete('posts', $where);
    			return $this->_helper->redirector('index');
    		} else {
    			$mapper->find($request->post_id, $post);
    			$this->view->post = $post;
    		}
    	}
        
    }


}





