<?php

class FeedController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('naked');
    }

    /**
     * Docs: http://framework.zend.com/manual/en/zend.feed.writer.html
     */
    public function indexAction()
    {
    	$mapper = new Application_Model_PostsMapper();
    	$posts = $mapper->fetchAll(null, 'date ASC');
    	
    	if (count($posts)) {
    		/**
    		 * Create the parent feed
    		 */
    		$feed = new Zend_Feed_Writer_Feed();
    		$feed->setTitle('Wannabekiwi');
    		$feed->setDescription('Best content about immigration and life in New Zealand in one place');
    		$feed->setLink('http://wannabekiwi.ru');
    		$feed->setFeedLink('http://wannabekiwi.ru/feed', 'rss');
    		$feed->addAuthor(array(
    				'name'  => 'Elena Kondrateva',
    				'email' => 'elena@kondrateva.com',
    				'uri'   => 'http://kondrateva.com',
    		));
    		$feed->setDateModified(time());
    		
    		foreach($posts as $post) {
    			$entry = $feed->createEntry();
    			$entry->setTitle(html_entity_decode($post->title));
    			$entry->setLink($post->link);
    			$entry->addAuthor(array(
    					'name'  => $post->author
    			));
    			$entry->setDateModified(time());
    			$entry->setDateCreated(new Zend_Date($post->date, Zend_Date::ISO_8601));
    			$entry->setDescription(html_entity_decode($post->text));
    			$entry->setContent(html_entity_decode($post->content));
    			$feed->addEntry($entry);
    		}
    		 
    		$out = $feed->export('rss');
    		echo $out;
    		exit();
    	} else {
    		//TODO: error
    	}
    }

    /**
     * Adds new posts from feed
     * Docs: http://framework.zend.com/manual/en/zend.feed.reader.html
     *
     * @param string $feed URL of RSS-feed
     *
     */
    private function updatePostsFromFeed($feed, $type=null, $filters=array())
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
    		$title = $htmlEntities->filter($entry->getTitle()); //TODO check title as well
    		$link = $htmlEntities->filter($entry->getLink());
    	
    		//find post by link
    		$mapper = new Application_Model_PostsMapper();
    		$res = $mapper->fetchAll(array('link=?' => $link));
    	
    		//if post does not exist
    		if (empty($res)) {
    			$author = $entry->getAuthor(); //XXX: what if more than 1 author?
    			$author = $author['name'];
    			
    			//type of content
    			$text = $type=='description' ? $entry->getDescription() : $entry->getContent();
    			
    			//filters
    			if (count($filters)) {
    				foreach ($filters as $filter) {
    					switch ($filter) {
    						case 'strip_tags':
    							$text = strip_tags($text);
    							break;
    					}
    				}
    			}
    			
    			$edata = array(
    					'title'		 => $htmlEntities->filter($title),
    					'text'		 => $htmlEntities->filter($text),
    					'content'	 => $htmlEntities->filter($entry->getContent()),
    					'date' 		 => date('Y-m-d H:i:s', strtotime($entry->getDateCreated())),
    					'author'	 => $htmlEntities->filter($author),
    					'link'		 => $htmlEntities->filter($link),
    					'date_added' => date("Y-m-d H:i:s")
    			);
    			 
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
    	//get feeds
    	$db = Zend_Db_Table_Abstract::getDefaultAdapter();
    	$feeds = $db->fetchAll("SELECT * FROM resources");
    	 
    	foreach($feeds as $feed) {
    		if (!empty($feed['filters'])) {
    			$filters = explode(',', $feed['filters']);
    		} else {
    			$filters = array();
    		}
    		
    		$this->updatePostsFromFeed($feed['feed'], $feed['type'], $filters);
    	}
    }

}



