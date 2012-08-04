<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function run()
	{
	
		$resource = $this->getPluginResource('db');
		$dbAdapter = $resource->getDbAdapter();
		$dbAdapter->query("SET NAMES 'utf8'");
		Zend_Db_Table::setDefaultAdapter($dbAdapter);
	
		$fc = Zend_Controller_Front::getInstance();
	
		return Zend_Application_Bootstrap_Bootstrap::run();
	}
	
	protected function _initDoctype()
	{
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->setEncoding('UTF-8');
		$view->doctype('HTML5');
	}
}

