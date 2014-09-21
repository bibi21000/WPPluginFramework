<?php
/**
* 
*/

namespace WPPFW\Plugin\Config\XML;

# imoprts
use WPPFW\HDT;

/**
* 
*/
class PluginConfigDocument extends HDT\HDTDocument {

	/**
	* put your comment there...
	* 
	*/
	protected function definePrototypes() {
		# Plugin
		$plugin = new PluginPrototype('plugin');
		# Objects
		$object = new ObjectPrototype('config:object');
		$object->addPrototype('param', new ObjectParamPrototype('config:param'));
		# Child objects
		$plugin->addPrototype('objects', new ObjectsPrototype('config:objects'))
						->addPrototype('object', $object)
						->addPrototype('object/child', $object);
						
		# SimpleXML Document File
		$xmldoc = new \SimpleXMLElement(file_get_contents('c:\temp\xml-prototype-test.xml'));
		
		# SimpleXML Reader prototype 
		$readerPrototype = new HDT\XML\SimpleXMLReaderPrototype();
		$readerPrototype->addNamespace('config', 'http://www.xptdev.com/frameworks/wordpress/plugin');
		
		# Set Reader prototype
		$this->setDefaultReaderPrototype($readerPrototype);
		
		$plugin->loadWithData($this, $xmldoc);
		
		# Process
		$plugin->process();
	}
	
}