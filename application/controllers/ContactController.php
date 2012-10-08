<?php

require_once 'CommonController.php';

class ContactController extends CommonController
{

    public function indexAction()
    {
        $form = new Application_Form_Contact();
        $this->view->form = $form;
        
        //TODO: send email
    }


}

