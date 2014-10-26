<?php
/**
* 
*/

namespace WPPFW\MVC\Form\Renderer;

# Element interface
use WPPFW\MVC\Form\InputElement;

# Imrpost
use WPPFW\MVC\Form;

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
	* @param Form\FormRenderer $form
	* @param {Form\FormRenderer|InputElement} $element
	* @param {Form\FormRenderer|InputElement|IRenderer} $parent
	* @return {RendererBase|Form\FormRenderer|InputElement|IRenderer}
	*/
	public function __construct(Form\FormRenderer & $form, InputElement $element, IRenderer & $parent) {
		# INt vars
		$this->element =& $element;
		$this->form =& $form;
		$this->parentRenderer =& $parent;
		# Getting Full name
		$this->name = $form->getElementName($parent->getName(), $this->getElement()->getName());
		
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
	
}