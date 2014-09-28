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
class FiltersCollection extends ArrayIterator {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $filters = array();
	
	/**
	* put your comment there...
	* 
	*/
	public function __construct() {
		# Array iterator initialization
		parent::__construct($this->filters);
	}

	/**
	* put your comment there...
	* 
	* @param Filter $filer
	*/
	public function add(IFilter & $filter) {
		# Set
		$this->filters[] =& $filter;
		# Chain
		return $this;
	}

}