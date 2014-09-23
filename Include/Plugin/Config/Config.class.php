<?php
/**
* 
*/

namespace WPPFW\Plugin;

# imports
use WPPFW\Plugin\Config\XML;

/**
* 
*/
class PluginConfig {

	/**
	* SimpleXMLElement
	* 
	* @var mixed
	*/
	protected $simpleXML;
	
	/**
	* put your comment there...
	* 
	* @var Config\XML\PluginConfigDocument
	*/
	protected $xmlDocument;
	
	/**
	* put your comment there...
	* 
	* @param mixed $xmlData
	* @return PluginConfig
	*/
	public function __construct($xmlData) {
		# Creating XML Document
		$this->xmlDocument = new XML\PluginConfigDocument();
		# Load document.
		$this->load($xmlData);
	}

	/**
	* put your comment there...
	* 
	* @param mixed $xmlData
	*/
	private function load($xmlData) {						
		# SimpleXML Document File
		$this->simpleXML = new \SimpleXMLElement($xmlData);
		
		# Load document
		$rootPrototype =& $this->getHDTXMLDoc()->getRootPrototype();
		$rootPrototype->loadWithData($this->getHDTXMLDoc(), $this->getSimpleXML());
		
		# Resolve namespace.		
		$rootPrototype->transform('initialize');
	}

	/**
	* put your comment there...
	* 
	*/
	public function & loadMVCObjects() {
		# Initialize
		$document =& $this->getHDTXMLDoc();
		$mvcPrototype =& $document->getMVC();
		# Load MVC Objects
		$mvcPrototype->transform('getObject')->transform('getType');
		# Chain
		return $this;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & loadServices() {
		# Initialize
		$document =& $this->getHDTXMLDoc();
		# Load Services
		$servicesPrototype =& $document->getServices();
		
		$servicesPrototype->transform('getService')
		# Load services objects
										 	->transform('getObject');
		# Chain
		return $this;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getHDTXMLDoc() {
		return $this->xmlDocument;
	}
	
	/**
	* put your comment there...
	* 
	* @param mixed $serviceObject
	* @param mixed $proxy
	*/
	public function & getService(& $serviceObject, & $proxy) {
		# Initialize
		$hdtDocument =& $this->getHDTXMLDoc();
		$plugin =& $hdtDocument->getRootPrototype();
		$mvc =& $plugin->getPrototypeInstance('mvc');
		$globalObjects =& $mvc->getPrototypeInstance('objects')->getResult();
		$mvcTypes =& $mvc->getPrototypeInstance('types')->getResult();
		# Services list
		$services =& $plugin->getPrototypeInstance('services')->getResult();
		# Service configuration
		$serviceConfig =& $services[get_class($serviceObject)];
		# Add requested proxy key as property
		$serviceConfig['proxy'] =& $serviceConfig['proxies'][get_class($proxy)];
		$proxyConfig =& $serviceConfig['proxy'];
		$objects =& $proxyConfig['objects'];
		# Geting type
		$serviceConfig['type'] =& $mvcTypes[$proxyConfig['typeName']];
		# Get all TYPES objects even those are not defined
		# inside the proxy tag.
		foreach ($serviceConfig['type'] as $name => $class) {
			# Add global class if its not already defined inside
			# proxy objects!
			if (!isset($objects[$class])) {
				$objects[$class] =& $globalObjects[$class];
			}
		}
		# Returns
		return $serviceConfig;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getSimpleXML() {
		return $this->simpleXML;
	}
	
}