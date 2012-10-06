<?php

require_once 'CommonController.php';

class LinksController extends CommonController
{

    public function indexAction()
    {
    	//get links
    	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
    	$this->view->links = $db->fetchAll("SELECT link, description FROM resources");
    }


}

