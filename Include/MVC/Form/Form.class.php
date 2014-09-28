<?php
/**
* 
*/

namespace WPPFW\MVC\Form;

/**
* 
*/
class Form extends ElementsCollection {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $invalidElements;

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $prefix;
	
	/**
	* put your comment there...
	* 
	* @param mixed $prefix
	* @return Form
	*/
	public function __construct($prefix) {
		# Initialize parent.
		parent::__construct();
		# Initaiuze vars
		$this->prefix = strtolower($prefix);
	}

	/**
	* put your comment there...
	* 
	*/
	public function & clear() {
		# Reset validation state
		$this->invalidElements = null;			
		# Chain
		return $this;
	}

	/**
	* put your comment there...
	* 
	*/
	public function getData() {
		# Aggregate all fields data
		$this->getElementsData($this, $data, $this->getPrefix());
		# Returns data
		return $data;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $prefix
	* @param mixed $name
	*/
	protected function getElementName($name, $prefix) {
		# Prefixing element name
		return "{$prefix}{$name}";
	}

	/**
	* put your comment there...
	* 
	* @param ElementsCollection $elements
	* @param mixed $data
	* @param mixed $prefix
	* @return []
	*/
	protected function getElementsData(ElementsCollection & $elements, & $data, $prefix = '') {
		# Set values for all elements
		foreach ($elements as $element) {
			# Validate input elements
			if ($element instanceof IInputElement) {
				# Element name
				$elementName = $this->getElementName($element->getName(), $prefix);
				# Get element value
				$data[$elementName] = $element->getValue();
			}
			# If elements collection is supplied then
			# validate elements inside
			else {
				# If current element is Structure then break the struture
				# level inside!
				if ($element instanceof IElementsStructure) {
					$data =& $data[$this->getElementName($element->getName(), $prefix)];
				}
				# Process IContainerElement and IStructuredElement
				$this->getElementsData($element->elements(), $data);
			}
		}
		return $data;		
	}

	/**
	* put your comment there...
	* 
	*/
	public function getPrefix() {
		return $this->prefix;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function isValidated() {
		return (($this->invalidElements !== null) && !$this->invalidElements);
	}

	/**
	* put your comment there...
	* 
	* @param mixed $values
	*/
	public function & setData($values) {
		return $this->setElementsData($this, $values, $this->getPrefix());
	}

	/**
	* put your comment there...
	* 
	* @param ElementsCollection $elements
	* @param mixed $values
	* @param mixed $prefix
	* @return Form
	*/
	protected function & setElementsData(ElementsCollection & $elements, & $values, $prefix = '') {
		# Set values for all elements
		foreach ($elements as $element) {
			# Validate input elements
			if ($element instanceof IInputElement) {
				# Element name
				$elementName = $this->getElementName($element->getName(), $prefix);
				# Get element value
				$value = isset($values[$elementName]) ? $values[$elementName] : null;
				# Set element value
				$element->setValue($value);
			}
			# If elements collection is supplied then
			# validate elements inside
			else {
				# Declare value var
				$value = null;
				# If current element is Structure then break the struture
				# level inside!
				if ($element instanceof IElementsStructure) {
					# Get element name
					$elementName = $this->getElementName($element->getName(), $prefix);
					# Reading value.
					if (isset($values[$elementName])) {
						$value = $values[$elementName];
					}
				}
				else {
					$value = $values;
				}
				# Process IContainerElement and IStructuredElement
				$this->setElementsData($element->elements(), $value);
			}
		}
		return $this;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & validate() {
		# Validate form elements and all elements inside
		return $this->validateElements($this);
	}

	/**
	* put your comment there...
	* 
	* @param IInputElement $element
	*/
	protected function validateElement(IInputElement & $element) {
		return $element->validate();
	}

	/**
	* put your comment there...
	* 
	* @param ElementsCollection $elements
	*/
	protected function & validateElements(ElementsCollection & $elements) {
		# Validate elements
		foreach ($elements as $element) {
			# If elements collection is supplied then
			# validate elements inside
			if ($element instanceof IElementsContainer) {
				$this->validateElements($element->elements());
			}
			# Validate input elements
			else {
				# Add invalid elements to flat invalids list
				if (!$this->validateElement($element)) {
					$this->invalidElements[$element->getId()] =& $element;
				}				
			}
		}
		# Chain
		return $this;
	}

}