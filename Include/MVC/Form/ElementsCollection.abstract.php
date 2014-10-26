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
class ElementsCollection extends ArrayIterator implements IElement {

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $elements = array();

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $id;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $name;
	
	/**
	* put your comment there...
	* 
	* @param mixed $id
	* @param mixed $name
	* @return ElementsCollection
	*/
	public function __construct($id, $name) {
		# Iterator
		parent::__construct($this->elements);
		# Init vars
		$this->id =& $id;
		$this->name =& $name;
	}
	
	/**
	* put your comment there...
	* 
	* @param IElement $element
	* @return IElement
	*/
	public function & add(IElement & $element) {
		# Add element
		$this->elements[] =& $element;
		# Chain
		return $element;
	}
	
	/**
	* put your comment there...
	* 
	* @param IElement $element
	* @return IElement
	*/
	public function & addChain(IElement & $element) {
		# Add element
		$this->elements[] =& $element;
		# Chain
		return $this;
	}

	/**
	* put your comment there...
	* 
	*/
	public function getId() {
		return $this->id;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function getName() {
		return $this->name;
	}

}