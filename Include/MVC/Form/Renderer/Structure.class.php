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
class StructuredElement extends Form\FormRendererElementsCollection implements IRenderer {
	
	/**
	* put your comment there...
	* 
	* @var Form\IElement
	*/
	protected $element;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $form;
	
	/**
	* put your comment there...
	* 
	* @param Form\FormRenderer $form
	* @param {Form\FormRenderer|IElement} $element
	* @return {StructuredElement|Form\FormRenderer|IElement}
	*/
	public function __construct(Form\FormRenderer & $form, Form\IElement & $element) {
		# Renders Collection base class
		parent::__construct();
		# INit vars
		$this->form =& $form;
		$this->element =& $element;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getElement() {
		return $this->element;
	}

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