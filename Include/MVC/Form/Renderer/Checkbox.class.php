<?php
/**
* 
*/

namespace WPPFW\MVC\Form\Renderer;

/**
* 
*/
class CheckBoxInputElement extends RendererBase {
	
	/**
	* put your comment there...
	* 
	* @param mixed $document
	* @param mixed $parent
	*/
	public function render(& $document, & $parent)	{
		$input = $document->createElement('input');
		$input->setAttribute('type', 'checkbox');
		$parent->appendChild($input);
		# Chain
		return $this;
	}

}