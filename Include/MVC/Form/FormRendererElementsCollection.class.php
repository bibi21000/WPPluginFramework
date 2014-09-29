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
abstract class FormRendererElementsCollection extends ArrayIterator {

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $elements = array();

	/**
	* put your comment there...
	* 
	*/
	public function __construct() {
		# Iterator
		parent::__construct($this->elements);
	}
	
	/**
	* put your comment there...
	* 
	* @param IElement $element
	* @return IElement
	*/
	public function & add($element) {
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
	public function & addChain($element) {
		# Add element
		$this->elements[] =& $element;
		# Chain
		return $this;
	}

	/**
	* put your comment there...
	* 
	* @param FormRendererElementsCollection $renderers
	* @param mixed $document
	* @param mixed $parent
	*/
	protected abstract function renderElementsList(FormRendererElementsCollection & $renderers, & $document, & $parent);
	
}