<?php

class CommonController extends Zend_Controller_Action
{

    /**
     * Pages
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

    /**
     * Initiate page layout according to input parameters
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
    	$current_controller = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();;
    
    	$top_menu = array();
    	$bottom_menu = array();
    	foreach (self::$pages as $controller => $data) {
    		if ($controller == $current_controller) {
    			$this->view->page = (object) $data;
    		}
    		if (isset($data['in_top_menu']) && $data['in_top_menu'] == true) {
    			$top_menu[$controller] = $data;
    		}
    		if (isset($data['in_bottom_menu']) && $data['in_bottom_menu'] == true) {
    			$bottom_menu[$controller] = $data;
    		}
    	}
    	$this->view->top_menu = $top_menu;
    	$this->view->bottom_menu = $bottom_menu;
    	$this->view->controller = $current_controller;
    }

}







