<?php
/**
* 
*/

namespace WPPFW\MVC\Form\Renderer;

/**
* 
*/
class InputGenericRow {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $renderer;
	
	/**
	* put your comment there...
	* 
	* @param IRenderer $renderer
	* @return {InputGenericRow|IRenderer}
	*/
	public function __construct(IRenderer & $renderer) {
		# Init vars
		$this->renderer =& $renderer;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getRenderer() {
		return $this->renderer;
	}
	
	/**
	* put your comment there...
	* 
	* @param mixed $document
	* @param mixed $parent
	* @return InputGenericRow
	*/
	public function render(& $document, & $parent) {
		# Creating row
		$row = $document->createElement('li');
		$parent->appendChild($row);
		# Label
		$label = $document->createElement('label');
		$label->setAttribute('for', uniqid());
		$label->nodeValue = $this->getRenderer()->getElement()->getName();
		$row->appendChild($label);
		# Renders original renderers
		$this->getRenderer()->render($document, $row);
		# Chain
		return $this;
	}
}