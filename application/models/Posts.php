<?php

class Application_Model_Posts
{
	protected $_id;
	protected $_date;
	protected $_title;
	protected $_text;
	protected $_content;
	protected $_author;
	protected $_link;
	protected $_date_added;
	protected $_resource_id;
	protected $_type_id;
	protected $_is_favourite;
	
	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}
	
	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid property: '.$name);
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid property: '.$name);
		}
		return $this->$method();
	}
	
	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}
	
	public function setId($id)
	{
		$this->_id = (int) $id;
		return $this;
	}
	public function getId()
	{
		return $this->_id;
	}
	
	public function setDate($date)
	{
		$this->_date = $date;
		return $this;
	}
	public function getDate()
	{
		return $this->_date;
	}
	
	public function setTitle($title)
	{
		$this->_title = (string) $title;
		return $this;
	}
	public function getTitle()
	{
		return $this->_title;
	}
	
	public function setText($text)
	{
		$this->_text = (string) $text;
		return $this;
	}
	public function getText()
	{
		return $this->_text;
	}
	
	public function setContent($content)
	{
		$this->_content = (string) $content;
		return $this;
	}
	public function getContent()
	{
		return $this->_content;
	}
	
	public function setAuthor($author)
	{
		$this->_author = (string) $author;
		return $this;
	}
	public function getAuthor()
	{
		return $this->_author;
	}
	
	public function setLink($link)
	{
		$this->_link = (string) $link;
		return $this;
	}
	public function getLink()
	{
		return $this->_link;
	}
	
	public function setDate_added($date)
	{
		$this->_date_added = $date;
		return $this;
	}
	public function getDate_added()
	{
		return $this->_date_added;
	}
	
	public function setResource_id($resource_id)
	{
		$this->_resource_id = (int) $resource_id;
		return $this;
	}
	public function getResource_id()
	{
		return $this->_resource_id;
	}
	
	public function setType_id($type_id)
	{
		$this->_type_id = (int) $type_id;
		return $this;
	}
	public function getType_id()
	{
		return $this->_type_id;
	}
	
	public function setIs_favourite($is_favourite)
	{
		$this->_is_favourite = (int) $is_favourite;
		return $this;
	}
	public function getIs_favourite()
	{
		return (int) $this->_is_favourite;
	}
	
	/*** validation ***/
	/**
	 * Validate the data
	 *
	 * @param array $properties - list of properies for validation
	 * @return true or array of invalid fields
	 */
	public function validate(array $properties)
	{
		$invalid_properties = array();
		foreach ($properties as $property) {
			$method = 'isValid' . ucfirst($property);
			if (method_exists($this, $method)) {
				$property_getter = 'get' . ucfirst($property);
				$value = $this->$property_getter();
	
				$validation_result = $this->$method($value);
				if ($validation_result !== true) {
					$invalid_properties[$property] = $validation_result;
				}
			}
		}
		if (count($invalid_properties)) {
			return $invalid_properties;
		}
		return true;
	}
	
	public function isValidId($id)
	{
		$validator = new Zend_Validate_Digits();
		if ($validator->isValid($id) && $id != 0) {
			return true;
		} else {
			$errors = '';
			// field is invalid; return the reasons
			foreach ($validator->getMessages() as $message) {
				$errors .= $message . PHP_EOL;
			}
			return $errors;
		}
	}
	
	public function isValidDate($date)
	{
		$validator = new Zend_Validate_Date(array('format' => 'Y-m-d H:i:s'));
		if ($validator->isValid($date)) {
			return true;
		} else {
			$errors = '';
			// field is invalid; return the reasons
			foreach ($validator->getMessages() as $message) {
				$errors .= $message . PHP_EOL;
			}
			return $errors;
		}
	}
	
	public function isValidTitle($title)
	{
		return false; //TODO
	}
	
	public function isValidText($text)
	{
		return false; //TODO
	}
	
	public function isValidAuthor($author)
	{
		return false; //TODO
	}
	
	public function isValidLink($link)
	{
		return false; //TODO
	}
	
	public function isValidDate_added($date)
	{
		return $this->isValidDate($date);
	}
	
	public function isValidResource_id($id)
	{
		return $this->isValidId($id);
	}
	
	public function isValidType_id($id)
	{
		return $this->isValidId($id);
	}
}

