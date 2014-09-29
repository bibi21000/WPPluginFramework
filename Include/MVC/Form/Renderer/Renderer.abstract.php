<?php
/**
* 
*/

namespace WPPFW\MVC\Form\Renderer;

# Element interface
use WPPFW\MVC\Form\IElement;

/**
* 
*/
abstract class RendererBase implements IRenderer {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $element;
	
	/**
	* put your comment there...
	* 
	* @param IElement $element
	* @return {RendererBase|IElement}
	*/
	public function __construct(IElement $element) {
		# INt vars
		$this->element =& $element;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getElement() {
		return $this->element;
	}
	
}