<?php
/**
* 
*/

namespace WPPFW\MVC\Form;

/**
* 
*/
class FormRenderer extends FormRendererElementsCollection {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $form;
	
	/**
	* put your comment there...
	* 
	* @var \DOMDocument
	*/
	protected $html;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $renderersNamespace;
	
	/**
	* put your comment there...
	* 
	* @param Form $form
	* @return {FormRenderer|Form}
	*/
	public function __construct(Form & $form) {
		# Initialize Elements collection
		parent::__construct();
		# Initialize
		$this->form =& $form;
		$this->html = new \DOMDocument();
		$this->renderersNamespace = dirname(get_class($this)) . '\Renderer';
		# Load elements
		$this->loadElementsList($this->form, $this);
	}
	
	/**
	* 
	* 
	*/
	public function __toString() {
		# Get HTML content string
		$html = $this->getDoc()->saveXML();
		# Returns
		return $html;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getDoc() {
		return $this->html;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getForm() {
		return $this->form;
	}
	
	/**
	* put your comment there...
	* 
	* @param IElement $element
	* @return IElement
	*/
	protected function getRenderClass(IElement & $element) {
		# Initialize
		$rendererClass = null;
		# Get all classes tree for form element
		$classes = class_parents($element);
		# Prepend element class
		array_unshift($classes, get_class($element));
		# Search for renderer class
		foreach ($classes as $class) {
			# Get from map if mapped
			if (isset($this->map[$class])) {
				$rendererClass = $class;				
				# Get out!
				break;
			}
			else {
				# Check relative to current-form-namespace\renderer namespace	
				$elementClassName = basename($class);
				$relativeRenderClass = "{$this->renderersNamespace}\\{$elementClassName}";
				# Check existyance
				if (class_exists($relativeRenderClass)) {
					$rendererClass = $relativeRenderClass;
					# Get out!
					break;
				}
			}
		}
		return $rendererClass;
	}

	/**
	* put your comment there...
	* 
	* @param ElementsCollection $elements
	* @param {ElementsCollection|FormRendererElementsCollection} $pElement
	* @return {ElementsCollection|FormRenderer|FormRendererElementsCollection}
	*/
	protected function loadElementsList(ElementsCollection & $elements, FormRendererElementsCollection & $pRenderer) {
		# Getting all elements.
		foreach ($elements as $element) {
			# Get render class for current elemet
			$renderClass = $this->getRenderClass($element);
			if (!$renderClass) {
				$elementClass = get_class($element);
				throw new \Exception("Cannot render Element type : {$elementClass}");
			}
			# Recusive
			if ($element instanceof IElementsStructure) {
				# Creating Structure element
				$renderer = new $renderClass($this, $element);
				# Do Recusive elements
				$this->loadElementsList($element->elements(), $renderer);
			}
			else {
				# Creating inpu element render
				$renderer = new $renderClass($element);
			}
			# Add to parnt elements collection
			$pRenderer->add($renderer);
		}
		# Chain
		return $this;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $elementClass
	* @param mixed $renderClass
	*/
	public function & mapRenderClass($elementClass, $renderClass) {
		
	}

	/**
	* put your comment there...
	* 
	*/
	public function & render() {
		# Initialize 
		$form =& $this->getForm();
		$doc =& $this->getDoc();
		# Create form element
		$formElement = $doc->createElement('form');
		$list = $doc->createElement('ul');
		# Render all elements.
		$this->renderElementsList($this, $doc, $list);
		# Append for elements
		$formElement->appendChild($list);
		$doc->appendChild($formElement);		
		# Return HTML string
		return $this;
	}
	
	/**
	* put your comment there...
	* 
	* @param FormRendererElementsCollection $renderers
	* @param mixed $document
	* @param mixed $parent
	* @return FormRenderer
	*/
	protected function renderElementsList(FormRendererElementsCollection & $renderers, & $document, & $parent) {
		# Render elements
		foreach ($renderers as $renderer) {
			# Form row
			$row = ($renderer->getElement() instanceof IElementsStructure) ?
							new Renderer\StructureGenericRow($renderer) :
							new Renderer\InputGenericRow($renderer);
			# Render row
			$row->render($document, $parent);
			echo get_class($renderer->getElement()) . '<br>';
		}
		# Chain
		return $this;
	}

}