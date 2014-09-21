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
	protected function & definePrototypes() {
		# Plugin
		$plugin = new PluginPrototype('config:plugin');
		
		# Object and Child Objects
		$object = new ObjectPrototype('config:object');
		$object->addPrototype('param', new ObjectParamPrototype('config:param'));
		
		# MVC Config section, it retuned MVCPrototype(), dont get confused!
		$plugin->addPrototype('mvc', new MVCPrototype('config:mvc'))
	
		# Child objects
						->addPrototype('objects', new ObjectsPrototype('config:objects'))
						->addPrototype('object', $object)
						->addPrototype('object/child', $object);
		
		# SimpleXML Reader prototype 
		$readerPrototype = new PluginSimpleXMLReaderPrototype();
		$readerPrototype->addNamespace('config', 'http://www.xptdev.com/frameworks/wordpress/plugin');
		
		# Set Reader prototype
		$this->setDefaultReaderPrototype($readerPrototype);
		
		# Return root
		return $plugin;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getMVC() {
		return $this->getRootPrototype()->getPrototypeInstance('mvc');
	}
	
}