<?php
/**
* 
*/

namespace WPPFW\Plugin;

# Imports
use WPPFW\Services\IServiceFrontFactory;
use WPPFW\Obj\PHPNamespace;
use WPPFW\MVC\IDispatcher;
use WPPFW\Services\ProxyBase;

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
	* @var Request
	*/
	protected $inputs;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $namespace;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $url;
	
	/**
	* put your comment there...
	* 
	* @param mixed $file
	* @param mixed $namespace
	* @param mixed $config
	* @return PluginBase
	*/
	protected function __construct($file, PluginConfig $config) {
		# Initialize
		$this->file =& $file;
		$this->config =& $config;
		# getting namespace
		$pluginClassComponents = explode('\\', get_class($this));
		$this->namespace = new PHPNamespace(reset($pluginClassComponents), dirname($file));
		$this->inputs = new Request($_GET, $_POST, $_REQUEST);
		$this->url = plugin_dir_url($file);
	}

	/**
	* put your comment there...
	* 
	* @param mixed $service
	* @param mixed $serviceObject
	* @param ProxyBase $proxy
	* @return ProxyBase
	*/
	public function & createServiceFront(& $service, & $serviceObject, ProxyBase & $proxy) {
		# Initialize
		$config =& $this->getConfig();
		# Load MVC Configuration objects
		$config->loadMVCObjects()
		# Load Services Configuration objects
					 ->loadServices();
		# Get service configuration
		$serviceConfig =& $config->getService($serviceObject, $proxy);
		# Get Front Proxy class
		$frontProxyClass = $serviceConfig['proxy']['frontClass'];
		# Create Front Proxy object
		$frontProxy = new $frontProxyClass();
		# Getting Service MVC configuration (target, sructure, etc...)
		$frontProxy->proxy($this, $serviceConfig);
		# Create Service Front object
		$serviceFrontClass = $serviceConfig['serviceFront'];
		$serviceFront = new $serviceFrontClass($frontProxy->getStructure(), $frontProxy->getTarget());
		# return servie fron
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
	* @return PluginConfig
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
	public function & getInputs() {
		return $this->inputs;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getNamespace() {
		return $this->namespace;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function getURL() {
		return $this->url;
	}
	
}