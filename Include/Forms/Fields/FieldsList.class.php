<?php
/**
* 
*/

namespace WPPFW\Forms\Fields;

# Imports
use WPPFW\Forms\Types\TypeArray;

/**
* 
*/
abstract class FormFieldsList extends FormFieldBase {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $fields;

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $validated;

	/**
	* put your comment there...
	* 
	*/
	public function & getFields() {
		return $this->fields;
	}
	
	/**
	* put your comment there...
	* 
	*/
	protected function getType() {
		return new TypeArray();
	}

	/**
	* 
	*/
	public function getValue() {
		# Initialize 
		$value = array();
		$fields =& $this->getFields();
		# Aggregate fields value
		foreach ($fields as $index => $field) {
			# Get value for every fied inside the fields list.
			$value[$index] = $field->getValue();
		}
		# Return value
		return $value;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & validate() {
		# INitialize
		$fields =& $this->getFields();
		$this->validated = true;
		# Validate fields
		foreach ($fields as $field) {
			# Any soingle invalid field would cause to return invalid
			if (!$field->validate() && $this->validated) {
				# Mark as invalie
				$this->validated = false;
			}
		}
		# Return vaidation state
		return $this->validated;
	}

}