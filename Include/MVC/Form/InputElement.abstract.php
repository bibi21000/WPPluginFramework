<?php
/**
* 
*/

namespace WPPFW\MVC\Form;

/**
* 
*/
abstract class InputElement extends Element implements IInputElement {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $filters;
	
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
	protected $rules;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $type;

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $value;
	
	/**
	* put your comment there...
	* 
	* @param mixed $id
	* @param mixed $name
	* @param IType $type
	* @return {Element|IType}
	*/
	public function __construct($id, $name, IType & $type = null) {
		# Element base
		parent::__construct($id);
		# Initialize object vars
		$this->rules = new RulesCollection();
		$this->filters = new FiltersCollection();
		# Default type unless being overrided
		$this->name =& $name;
		$this->type =& $type;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & applyFilters() {
		
		# Chain
		return $this;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & applyRules() {

		# Chain
		return $this;		
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & applyType() {
		
	}
	
	/**
	* 
	*/
	public function & filters() {
		return $this->filters;
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
	public function getValue() {
		return $this->value;
	}

	/**
	* 
	*/
	public function & rules() {		
	  return $this->rules;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $value
	*/
	public function & setValue($value) {
		# Set
		$this->value =& $value;
		# Chain
		return $this;
	}

	/**
	* 
	*/
	public function & type() {
		return $this->type;
	}

	/**
	* put your comment there...
	* 
	*/
	public function validate() {
		
	}
	
}
