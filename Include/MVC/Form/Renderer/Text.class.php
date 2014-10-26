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
		# Create input element
		$input = $document->createElement('input');
		# Set as type text
		$input->setAttribute('type', 'text');
		# Set value
		$input->setAttribute('value', $this->getElement()->getValue());
		# Set name
		$input->setAttribute('name', $this->getName());
		# Append to doc
		$parent->appendChild($input);
		# Chain
		return $this;
	}

}