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
	* put your comment there...
	* 
	* @var PluginConfigPipe
	*/
	protected $pipe;
	
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
		# Getting MVC objects
		$this->pipe = new XML\PluginConfigPipe();
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
		$rootPrototype->transform('resolveNamespaces');
	}

	/**
	* put your comment there...
	* 
	*/
	public function & loadMVCObjects() {
		# Initialize
		$document =& $this->getHDTXMLDoc();
		$mvcPrototype =& $document->getMVC();
		$pipe =& $this->getPipe();
		# Set Pipe current object type
		$pipe->setCurrentObjectType('mvc');
		# load
		$mvcPrototype->transform('getObject', $pipe);
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
	*/
	protected function & getPipe() {
		return $this->pipe;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getSimpleXML() {
		return $this->simpleXML;
	}
	
}