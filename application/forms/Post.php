<?php

class Application_Form_Post extends Zend_Form
{

    protected $post;

    public function setPost($post)
    {
        $this->post = $post;
        return $this;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function init()
    {
        $post = $this->post;

        $this->setMethod('post');
        $this->setAttrib('accept-charset', 'utf-8');
        $required_suffix = ' * ';

        $this->addElement('text', 'title', array(
            'label'	=> 'Title',
            'value' => $post->title
        ));
        $this->addElement('textarea', 'text', array(
            'label'	=> 'Text',
            'value' => $post->text
        ));
        $this->addElement('text', 'author', array(
        		'label'	=> 'Author',
        		'value' => $post->author
        ));
        $this->addElement('text', 'link', array(
        		'label'	=> 'Link',
        		'value' => $post->link
        ));
        $this->addElement('checkbox', 'is_favourite', array(
        		'label'	=> 'Favourite',
        		'value' => $post->is_favourite
        ));
        $this->addElement('text', 'date_added', array(
        		'label'	=> 'Date added',
        		'value' => $post->date_added
        ));
        $this->addElement('submit', 'submit', array(
            'ignore'	=> true,
            'label'		=> 'Save'
        ));

        $this->addElement('hidden', 'id', array(
        	'value' => $post->id
        ));
    }


}

