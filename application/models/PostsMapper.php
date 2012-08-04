<?php

class Application_Model_PostsMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Application_Model_DbTable_Posts');
		}
		return $this->_dbTable;
	}
	
	public function save(Application_Model_Posts $posts)
	{
		$data = array(
				'id'			=> $posts->getId(),
				'date'          => $posts->getDate(),
				'title'			=> $posts->getTitle(),
				'text'			=> $posts->getText(),
				'author'		=> $posts->getAuthor(),
				'link'			=> $posts->getLink(),
				'date_added'	=> $posts->getDate_added(),
				'resource_id'	=> $posts->getResource_id(),
				'type_id'		=> $posts->getType_id(),
				'is_favourite'	=> $posts->getIs_favourite()
		);
		
		$id = $posts->getId();
		if (empty($id)) {
			unset($data['id']);
			$result = $this->getDbTable()->insert($data);
		} else {
			$result = $this->getDbTable()->update($data, array('id = ?' => $id));
		}
		return $result;
	}
	
	public function find($id, Application_Model_Posts $posts)
	{
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
		$this->_rowToObj($row, $posts);
	}
	
	private function _rowToObj($row, Application_Model_Posts $posts)
	{
		$posts->setId($row->id)
		->setDate($row->date)
		->setTitle($row->title)
		->setText($row->text)
		->setAuthor($row->author)
		->setLink($row->link)
		->setDate_added($row->date_added)
		->setResource_id($row->resource_id)
		->setType_id($row->type_id)
		->setIs_favourite($row->is_favourite);
	}
	
	public function fetchAll($where=null,$order=null,$count=null,$offset=null)
	{
		$resultSet = $this->getDbTable()->fetchAll($where,$order,$count,$offset);
		$entries   = array();
		foreach ($resultSet as $row) {
			$entry = new Application_Model_Posts();
			$this->_rowToObj($row, $entry);
			$entries[] = $entry;
		}
		return $entries;
	}
}

