<?php
/**
* 
*/

namespace WPPFW\MVC\Form;

/**
* 
*/
abstract class Element implements IElement {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $id;

	/**
	* put your comment there...
	* 
	* @param mixed $id
	* @return Element
	*/
	public function __construct($id) {
		# Init vars
		$this->id =& $id;
		# Initialize model
		$this->initialize();
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
	protected function initialize() {;}
	
}