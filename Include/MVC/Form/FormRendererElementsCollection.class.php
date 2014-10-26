<?php
/**
* 
*/

namespace WPPFW\MVC\Form;

# Array Iterator
use WPPFW\Collection\ArrayIterator;

/**
* 
*/
abstract class FormRendererElementsCollection extends ArrayIterator implements Renderer\IRenderer {

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
	* @var mixed
	*/
	protected $elements = array();

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $name;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $parentRenderer;

	/**
	* put your comment there...
	* 
	* @param Form\IElement $element
	* @param {Form\IElement|IRenderer} $parent
	* @return {FormRendererElementsCollection|Form\IElement|IRenderer}
	*/
	public function __construct(FormRenderer & $form, IElement & $element, Renderer\IRenderer & $parent = null) {
		# Iterator
		parent::__construct($this->elements);
		# INit vars
		$this->form =& $form;
		$this->element =& $element;
		$this->parentRenderer =& $parent;
		# Build renderer name
		$this->name = $this->buildNameString();
	}
	
	/**
	* put your comment there...
	* 
	* @param IElement $element
	* @return IElement
	*/
	public function & add($element) {
		# Add element
		$this->elements[] =& $element;
		# Chain
		return $element;
	}
	
	/**
	* put your comment there...
	* 
	* @param IElement $element
	* @return IElement
	*/
	public function & addChain($element) {
		# Add element
		$this->elements[] =& $element;
		# Chain
		return $this;
	}

	/**
	* put your comment there...
	* 
	*/
	protected function buildNameString() {
		# Build name
		$name = $this->form->getElementName($this->getParent()->getName(), $this->getElement()->getName());
		# Chain
		return $name;
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
	*/
	public function getName() {
		return $this->name;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getParent() {
		return $this->parentRenderer;
	}

	/**
	* put your comment there...
	* 
	* @param FormRendererElementsCollection $renderers
	* @param mixed $document
	* @param mixed $parent
	*/
	protected abstract function renderElementsList(FormRendererElementsCollection & $renderers, & $document, & $parent);
	
}