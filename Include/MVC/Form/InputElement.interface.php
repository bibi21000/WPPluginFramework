<?php
/**
* 
*/

namespace WPPFW\MVC\Form;

/**
* 
*/
interface IInputElement extends IElement {

	/**
	* 
	*/
	public function getValue();
	
	/**
	* 
	*/
	public function & setValue($value);
	
	/**
	* 
	*/
	public function validate();
}