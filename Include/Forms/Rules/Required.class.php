<?php
/**
* 
*/

# Define namespace
namespace WPPFW\Forms\Rules;

/**
* 
*/
class RequiredField extends FieldRule {
	
	/**
	* put your comment there...
	* 
	*/
	public function validate() {
		# Initialize
		$valid = true;
		# Chekck
		if (!$this->getValue()) {
			# Set as not valid
			$valid = false;
			# Error message
			$this->setErrorMessage('Cannot be empty');
		}
		return $valid;
	}

}