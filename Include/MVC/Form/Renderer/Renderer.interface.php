<?php
/**
* 
*/

namespace WPPFW\MVC\Form\Renderer;

/**
* 
*/
interface IRenderer {
	
	/**
	* 
	*/
	public function & getElement();
	
	/**
	* 
	*/
	public function getName();

	/**
	* 
	*/
	public function & getParent();
	
	/**
	* 
	*/
	public function render(& $document, & $parent);
	
}