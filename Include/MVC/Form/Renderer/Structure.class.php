<?php
/**
* 
*/

namespace WPPFW\MVC\Form\Renderer;

# Imports
use WPPFW\MVC\Form;

/**
* 
*/
class StructuredElement extends Form\FormRendererElementsCollection {
	
	/**
	* put your comment there...
	* 
	* @param Form\FormRendererElementsCollection $renderers
	* @param mixed $document
	* @param mixed $parent
	* @return StructuredElement
	*/
	public function render(& $document, & $parent) {
		# Field set
		$fieldSet = $document->createElement('fieldset');
		$parent->appendChild($fieldSet);
		# Render
		$this->form->renderElementsList($this, $document, $fieldSet);
		# Chain
		return $this;
	}
	
	/**
	* put your comment there...
	* 
	* @param Form\FormRendererElementsCollection $renderers
	* @param mixed $document
	* @param mixed $parent
	*/
	protected function renderElementsList(Form\FormRendererElementsCollection & $renderers, & $document, & $parent) {
		return $this->form->renderElementsList($renderers, $document, $parent);
	}

}