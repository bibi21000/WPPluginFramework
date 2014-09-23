<?php
/**
* 
*/

namespace WPPFW\Obj;

/**
* 
*/
class Factory implements IFactory {

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $objects;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $rootNS;
	
	/**
	* put your comment there...
	* 
	* @param mixed $namespace
	* @return Factory
	*/
	public function __construct($namespace)	{
		# Initialize
		$this->rootNS =& $namespace;
	}
	
	/**
	* put your comment there...
	* 
	* @param mixed $class
	* @param mixed $instance
	*/
	public function & setInstance($class, & $instance) {
		# Add instance
		$this->objects[$class] =& $instance;
		# Chain
		return $this;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $class
	*/
	public function & create($class) {
		# Add namepsace to class
		$class = $this->getNamespace() . '\\' . $class;
		# Creating Factory object
		$objectFactory = new $class();
		# Creating orignal object
		$object = $objectFactory->getInstance($this);
		# Returning object
		return $object;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $class
	*/
	public function & get($class) {
		# Create object if not already created
		if (!isset($this->objects[$class])) {
			# Caching and Creating object
			$this->objects[$class] = $this->create($class);
		}
		# Return object
		return $this->objects[$class];
	}

	/**
	* put your comment there...
	* 
	* @param mixed $class
	*/
	public function getFullClassName($class) {
		return $this->getNamespace() . "\\{$class}";
	}

	/**
	* put your comment there...
	* 
	*/
	public function getNamespace() {
		return $this->rootNS;
	}
	
}
