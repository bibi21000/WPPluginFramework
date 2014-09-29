<?php
/**
* 
*/

namespace WPPFW\MVC\Form\Renderer;

/**
* 
*/
class TextBoxInputElement extends RendererBase {

	/**
	* put your comment there...
	* 
	* @param mixed $document
	*/
	public function render(& $document, & $parent)	{
		$input = $document->createElement('input');
		$input->setAttribute('type', 'text');
		$parent->appendChild($input);
		# Chain
		return $this;
	}

}