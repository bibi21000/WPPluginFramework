<?php
/**
* 
*/

namespace WPPFW\MVC\Model;

# Imports
use WPPFW\MVC;
use WPPFW\Database\Wordpress\WPOptionVariable;

/**
* 
*/
abstract class ModelBase extends MVC\MVCComponenetsLayer {

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	private $params;

	/**
	* put your comment there...
	* 
	* @var WPOptionVariable
	*/
	private $stateVariable;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	private $wpOptions;

	/**
	* put your comment there...
	* 
	* @param MVC\IMVCComponentsLayer $serviceManager
	* @return {ModelBase|MVC\IMVCComponentsLayer}
	*/
	public function __construct(MVC\IMVCServiceManager & $serviceManager) {
		# MVC layer
		parent::__construct($serviceManager);
		# Model params
		$this->params = new \WPPFW\Collection\DataAccess();
		# Next layer initialization
		$this->initialize();
		# State Option Variable
		$this->stateVariable = new WPOptionVariable(strtolower('model-state_' . get_class($this)), array());
		$this->wpOptions = $this->getFactory()->get('WPPFW\Database\Wordpress\WordpressOptions');
		# Read state
		$this->readState();
		# After read state initialization
		$this->initialized();
	}

	/**
	* put your comment there...
	* 
	* @param mixed $modelClass
	* @param MVC\IMVCComponentsLayer $serviceManager
	*/
	public static function & getInstance($modelClass, MVC\IMVCServiceManager & $serviceManager) {
		# Creating model
		$model = new $modelClass($serviceManager);
		# Returns
		return $model;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getFactory() {
		return $this->getMVCServiceManager()->getFactory();
	}
	
	/**
	* put your comment there...
	* 
	*/
	protected function & getStateOptionVar() {
		return $this->stateVariable;
	}
	
	/**
	* put your comment there...
	* 
	*/
	protected function & getWPOptions() {
		return $this->wpOptions;
	}
	
	/**
	* put your comment there...
	* 
	*/
	protected function initialize() {;}
	
	/**
	* put your comment there...
	* 
	*/
	protected function initialized() {;}
	
	/**
	* put your comment there...
	* 
	*/
	public function & params() {
		return $this->params;
	}

	/**
	* put your comment there...
	* 
	*/
	public function readState() {
		# Initialize vars
		$stateVar =& $this->getStateOptionVar();
		$wpOptions =& $this->getWPOptions();
		# Querying state
		$wpOptions->get($stateVar);
		# Copying state data to current instance
		foreach ($stateVar->getValue() as $propName => $value) {
			# Set value
			$this->$propName = $value;
		}
	}

	/**
	* put your comment there...
	* 
	*/
	public function writeState() {
		# Initialize vars
		$state = array();
		$moduleClassReflection = new \ReflectionClass($this);
		$wpOptions =& $this->getWPOptions();
		$stateVar =& $this->getStateOptionVar();
		# Copy all protected properties
		$statePropperties = $moduleClassReflection->getProperties(\ReflectionProperty::IS_PROTECTED);
		foreach ($statePropperties as $property) {
			# Getting property name
			$propertyName = $property->getName();
			# get value.
			$state[$propertyName] =& $this->$propertyName;
		}
		# Write Wordpress options table
		$stateVar->setValue($state);
		$wpOptions->set($stateVar);
		# Chain
		return $this;
	}

}

