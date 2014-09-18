<?php
/**
* 
*/

namespace WPPFW\Plugin;

# Imports
use WPPFW\Services\IServiceFrontFactory;
use WPPFW\Obj\PHPNamespace;
use WPPFW\MVC\IDispatcher;

/**
* 
*/
abstract class PluginBase implements IServiceFrontFactory {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $config;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $file;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $namespace;
	
	/**
	* put your comment there...
	* 
	* @param mixed $file
	* @param mixed $namespace
	* @param mixed $config
	* @return PluginBase
	*/
	protected function __construct($file, $config) {
		# Initialize
		$this->file =& $file;
		$this->config =& $config;
		$this->namespace = new PHPNamespace(reset(explode('\\', get_class($this))), dirname($file));
	}

	/**
	* put your comment there...
	* 
	* @param mixed $service
	*/
	public function & createServiceFront(& $serviceObject) {
		# Getting Service Front Object mapped to service object namespace
		$serviceObjectNamespace = dirname(get_class($serviceObject));
		$serviceFrontName = basename($serviceObjectNamespace);
		$serviceFrontClass = "{$serviceObjectNamespace}\\{$serviceFrontName}";
		# Instantiate Service fron object
		$serviceFront = new $serviceFrontClass($serviceObject);
		# Return service fron
		return $serviceFront;
	}

	/**
	* put your comment there...
	* 
	* @param IDispatcher $serviceFront
	* @return IDispatcher
	*/
	public function & dispatch(IDispatcher & $serviceFront) {
		# Dispatch the call
		return $serviceFront->dispatch();
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getConfig() {
		return $this->config;
	}

	/**
	* put your comment there...
	* 
	*/
	public function getFile() {
		return $this->file;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getNamespace() {
		return $this->namespace;
	}
	
}