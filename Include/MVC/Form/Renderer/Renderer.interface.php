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
	public function render(& $document, & $parent);
	
}