<?php
/**
* 
*/

namespace WPPFW\MVC;

#Imports
use WPPFW\Collection\IDataAccess;

/**
* 
*/
class MVCRequestParamsRouter {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $inputs;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $names;

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $outParams;
	
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
	* @param IDataAccess $inputs
	* @param {IDataAccess|MVCParams} $defaults
	* @param {IDataAccess|MVCParams|MVCParams} $names
	* @param {IDataAccess|MVCParams|MVCParams|MVCParams} $outParams
	* @return {MVCRequestParamsRouter|IDataAccess|MVCParams|MVCParams|MVCParams}
	*/
	public function __construct($prefix, IDataAccess & $inputs, MVCParams & $names, MVCParams & $outParams) {
		# Initialize
		$this->prefix = strtolower($prefix);
		$this->inputs =& $inputs;
		$this->names =& $names;
		$this->outParams =& $outParams;
		# Getting names as protected properties
		$reflection = new \ReflectionClass($names);
		$properties = $reflection->getProperties(\ReflectionProperty::IS_PROTECTED);
		# Getting inputs
		foreach ($properties as $property) {
			# Getting input  name
			$name = ucfirst($property->getName());
			# Getting getter method name
			$getter = "get{$name}";
			$setter = "set{$name}";
			# Bring from inputs only if it has source name and
			# the source name is found within the inputs!
			$inputName = $names->$getter();
			if (($inputName !== null) && (($inputValue = $inputs->get("{$this->prefix}{$inputName}")) !== null)) {
				$outParams->$setter($inputValue);
			}
		}
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getInputs() {
		return $this->inputs;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getNames() {
		return $this->names;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getOutParams() {
		return $this->outParams;
	}

	/**
	* put your comment there...
	* 
	*/
	public function getPrefix() {
		return $this->prefix;
	}
	
}