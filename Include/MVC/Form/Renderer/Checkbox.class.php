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
		# Init vars
		$element =& $this->getElement();
		$checkedValue = $element->getCheckedValue();
		$value = $element->getValue();
		# Create input element
		$input = $document->createElement('input');
		$parent->appendChild($input);
		# Set As Checkbox
		$input->setAttribute('type', 'checkbox');
		# Set name
		$input->setAttribute('name', $this->getName());
		# Set value
		$input->setAttribute('value', $checkedValue);
		# Check if checked
		if ($checkedValue == $value) {
			$input->setAttribute('checked', 'checked');	
		}
		# Chain
		return $this;
	}

}