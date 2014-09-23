<?php
/**
* 
*/

namespace WPPFW\Services;

# Plugin base
use WPPFW\Plugin\PluginBase;
use WPPFW\Services\IService;

/**
* 
*/
abstract class ServiceModule implements IService {

	/**
	* put your comment there...
	* 
	* @var PluginBase
	*/
	protected $plugin;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $services = array();

	/**
	* put your comment there...
	* 
	* @param PluginBase $plugin
	* @return {ServiceModule|PluginBase}
	*/
	public function __construct(PluginBase & $plugin) {
		# Initialize
		$this->plugin =& $plugin;
		# Initialize services
		$this->initializeServices($plugin, $this->services);
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getPlugin() {
		return $this->plugin;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getServices() {
		return $this->services;
	}

	/**
	* put your comment there...
	* 
	* @param PluginBase $plugin
	* @param mixed $services
	*/
	protected abstract function initializeServices(PluginBase & $plugin, & $services);

	/**
	* put your comment there...
	* 
	*/
	public function & start() {
		# Start services
		foreach ($this->getServices() as $service) {
			$service->start();
		}		
		# chain
		return $this;
	}
	
}
