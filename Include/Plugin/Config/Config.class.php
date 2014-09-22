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
		print_r($document->getRootPrototype()->getResult());
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
	public function & getServiceMVCObject(& $serviceObject, & $proxy) {
		
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getSimpleXML() {
		return $this->simpleXML;
	}
	
}