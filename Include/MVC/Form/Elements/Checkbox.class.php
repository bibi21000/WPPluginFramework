<?php
/**
* 
*/

namespace WPPFW\MVC\Form\Elements;

# Input element 
use WPPFW\MVC\Form\InputElement;

/**
* 
*/
class CheckBoxInputElement extends InputElement {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $checkedValue;
	
	/**
	* put your comment there...
	* 
	* @param mixed $id
	* @param mixed $name
	* @param IType $type
	* @return {Element|IType}
	*/
	public function __construct($id, $name, $checkedValue, IType & $type = null) {
		# Setting value.
		$this->checkedValue =& $checkedValue;
		# Element base
		parent::__construct($id, $name, $type);
	}

	/**
	* put your comment there...
	* 
	*/
	public function getCheckedValue() {
		return $this->checkedValue;
	}
	
}