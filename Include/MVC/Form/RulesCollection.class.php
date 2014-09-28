<?php
/**
* 
*/

namespace WPPFW\MVC\Form;

# Array Iterator
use WPPFW\Collection\ArrayIterator;

/**
* 
*/
class RulesCollection extends ArrayIterator {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $rules = array();
	
	/**
	* put your comment there...
	* 
	*/
	public function __construct() {
		# Array iterator initialization
		parent::__construct($this->rules);
	}

	/**
	* put your comment there...
	* 
	* @param Filter $filer
	*/
	public function add(IRule & $rule) {
		# Set
		$this->rules[] =& $rule;
		# Chain
		return $this;
	}

}