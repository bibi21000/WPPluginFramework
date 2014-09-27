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
	private $config;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	private $params;

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	private $stateAdapter;
	
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
		# Load config
		$this->config =& $this->loadConfig();
		# Create State adapter object associated with this model
		$this->stateAdapter = new $this->config['stateType']($this->factory(), get_class($this));
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
	protected function & getStateAdapter() {
		return $this->stateAdapter;
	}

	/**
	* put your comment there...
	* 
	* @return WPPFW\Obj\IFactory
	*/
	public function & factory() {
		return $this->mvcServiceManager()->factory();
	}
	
	/**
	* put your comment there...
	* 
	*/
	protected abstract function & loadConfig();
	
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
	public function & mvcTarget() {
		return $this->mvcServiceManager()->target();
	}
	
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
		$stateAdapter =& $this->getStateAdapter();
		# Copying state data to current instance
		foreach ($stateAdapter->read() as $propName => $value) {
			# Set value
			$this->$propName = $value;
		}
	}

	/**
	* put your comment there...
	* 
	*/
	public function & router() {
		return $this->mvcServiceManager()->router();
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function writeState() {
		# Initialize vars
		$stateVars = array();
		$stateAdapter =& $this->getStateAdapter();
		$moduleClassReflection = new \ReflectionClass($this);
		# Copy all protected properties
		$statePropperties = $moduleClassReflection->getProperties(\ReflectionProperty::IS_PROTECTED);
		foreach ($statePropperties as $property) {
			# Getting property name
			$propertyName = $property->getName();
			# get value.
			$stateVars[$propertyName] =& $this->$propertyName;
		}
		# Write to state adapter
		$stateAdapter->write($stateVars);
		# Chain
		return $this;
	}

}

