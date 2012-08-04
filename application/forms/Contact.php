<?php

class Application_Form_Contact extends Zend_Form
{

    public function init()
    {

        $this->setAction('');
        $this->setMethod('post');
        $this->setAttrib('accept-charset', 'utf-8');
        $required_suffix = ' * ';

        // form elements
        $name = new Zend_Form_Element_Text( 'name' );
        $name->setLabel( 'Name' )
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->removeDecorator('description')
          		->addErrorMessage('Please enter your name.');
        $this->addElement( $name );
        
        $email = new Zend_Form_Element_Text( 'email' );
        $email->setLabel( 'Email' )
                ->removeDecorator('description')
                ->setRequired( true )
                ->addValidator( 'EmailAddress',  true  )
                ->addValidator('NotEmpty', true)
          		->addErrorMessage('Please enter your email address.');
        $email->getDecorator('label')->setOption('requiredSuffix', $required_suffix);
        $this->addElement( $email );
        
        $message = new Zend_Form_Element_Textarea( 'message' );
        $message->setLabel( 'Message' )
                ->removeDecorator('description')
                ->setRequired( true )
                ->addValidator('NotEmpty', true)
          		->addErrorMessage('Please enter your message.');
        $message->getDecorator('label')->setOption('requiredSuffix', $required_suffix);
        $this->addElement( $message );

        $this->addElement('submit', 'submit', array(
            'ignore'	=> true,
            'label'		=> 'Submit'
        ));
    }
}