<?php

class IndexController extends Zend_Controller_Action
{

    /**
     * Pages
     *
     *
     *
     */
    private static $pages = array(
        'index' => array(
            'name' => 'Home',
            'header' => 'Posts',
            'in_top_menu' => true,
            'in_bottom_menu' => true
            ),
        'about' => array(
            'name' => 'About',
            'header' => 'About this website',
            'in_top_menu' => true,
            'in_bottom_menu' => true
            ),
        'links' => array(
            'name' => 'Links',
            'header' => 'Links',
            'in_top_menu' => true,
            'in_bottom_menu' => true
            ),
        'contact' => array(
            'name' => 'Contact',
            'header' => 'Contact',
            'in_top_menu' => true,
            'in_bottom_menu' => true
            )
        );

    public function init()
    {
    	$this->initPage();
        $this->initPageLayout();
    }

    public function indexAction()
    {
        // action body
    }

    /**
     * Initiate page layout according to input parameters
     *
     *
     *
     */
    protected function initPageLayout()
    {
    	if (isset($this->getRequest()->ajax)) {
    		$this->_helper->layout->setLayout('naked');
    	} else {
    		$this->_helper->layout->setLayout('index');
    	}
    }

    private function initPage()
    {
    	/* getting of current page data from $pages array */
    	$current_action = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
    
    	$top_menu = array();
    	$bottom_menu = array();
    	foreach (self::$pages as $action => $data) {
    		if ($action == $current_action) {
    			$this->view->page = (object) $data;
    		}
    		if (isset($data['in_top_menu']) && $data['in_top_menu'] == true) {
    			$top_menu[$action] = $data;
    		}
    		if (isset($data['in_bottom_menu']) && $data['in_bottom_menu'] == true) {
    			$bottom_menu[$action] = $data;
    		}
    	}
    	$this->view->top_menu = $top_menu;
    	$this->view->bottom_menu = $bottom_menu;
    	$this->view->action = $current_action;
    }

    public function aboutAction()
    {
        // action body
    }

    public function linksAction()
    {
        // action body
    }

    public function contactAction()
    {
        // action body
    }


}







