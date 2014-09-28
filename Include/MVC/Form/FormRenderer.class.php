<?php
/**
* 
*/

namespace WPPFW\MVC\Form;

/**
* 
*/
class FormRenderer {
	
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
		# Initialize
		$this->form =& $form;
		$this->html = new \DOMDocument();
		$this->renderersNamespace = dirname(get_class($this)) . '\Renderer';
	}
	
	/**
	* 
	* 
	*/
	public function __toString() {
		# Get HTML content string
		$html = $this->getDoc()->saveHTML();
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
		# Render all elements.
		$this->renderElementsList($form);
		# Return HTML string
		return $this;
	}
	
	/**
	* put your comment there...
	* 
	* @param ElementsCollection $elements
	* @return ElementsCollection
	*/
	protected function renderElementsList(ElementsCollection & $elements) {
		# Getting all elements.
		foreach ($elements as $element) {
			# Get render class for current elemet
			$renderClass = $this->getRenderClass($element);
			if (!$renderClass) {
				$elementClass = get_class($element);
				throw new \Exception("Cannot render Element type : {$elementClass}");
			}
			echo $renderClass . '<br>';
			# Create renderer element
			//$renderer = new $renderClass($element);
		}
		# Chain
		return $this;
	}

}