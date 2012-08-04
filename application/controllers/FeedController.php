<?php

class FeedController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('naked');
    }

    /**
     * Docs: http://framework.zend.com/manual/en/zend.feed.reader.html
     *
     */
    public function indexAction()
    {
   	
    }

    /**
     * Adds new post from feed
     *
     * @param string $feed URL of RSS-feed
     *
     */
    private function updatePostsFromFeed($feed)
    {
    	$feed = Zend_Feed_Reader::import($feed);
    	/*
    	 $data = array(
    	 		'title'        => $feed->getTitle(),
    	 		'link'         => $feed->getLink(),
    	 		'dateModified' => $feed->getDateModified(),
    	 		'description'  => $feed->getDescription(),
    	 		'language'     => $feed->getLanguage(),
    	 		'entries'      => array(),
    	 );
    	 
    	//TODO: check date updated of resource
    	 
    	*/
    	
    	$htmlEntities = new Zend_Filter_HtmlEntities();
    	foreach ($feed as $entry) {
    		$title = $htmlEntities->filter($entry->getTitle());
    	
    		//find post by title
    		$mapper = new Application_Model_PostsMapper();
    		$res = $mapper->fetchAll(array('title=?' => $title));
    	
    		//if post does not exists
    		if (empty($res)) {
    			$author = $entry->getAuthor(); //XXX: what if more than 1 author?
    			$author = $author['name'];
    			$edata = array(
    					'title'		 => $title,
    					'text'		 => $entry->getDescription(),
    					'date' 		 => $entry->getDateModified(),
    					'author'	 => $author,
    					'link'		 => $entry->getLink(),
    					'date_added' => date("Y-m-d H:i:s")
    			);
    			 
    			//filtering
    			foreach ($edata as $key => $value) {
    				$edata[$key] = $htmlEntities->filter($value);
    			}
    			 
    			//add to db
    			$post = new Application_Model_Posts($edata);
    			$id = $mapper->save($post);
    			 
    			if (is_numeric($id)) {
    				echo "Added entry ID" . $id . " &laquo;" . $title . "&raquo;<br />";
    			} else {
    				var_dump($id);
    			}
    		}
    	}
    }

    public function updateAction()
    {
        $feeds = array(
    		0 => array (
    			'url' => 'http://www.avalonsguide.com/anab/feed/',
    			'type' => 'description'	
    		),
        	1 => array (
        		'url' => 'http://www.aucklanddailyphoto.com/feed/',
        		'type' => 'content'
        	)
    	);
    	
    	foreach($feeds as $feed) {
    		$this->updatePostsFromFeed($feed['url'], $feed['type']);
    	} 
    }


}



