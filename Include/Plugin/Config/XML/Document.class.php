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
		$plugin = new PluginPrototype('plugin', 'config', 'http://www.xptdev.com/frameworks/wordpress/plugin');
		
		# Object and Child Objects
		$object = new Objects\ObjectPrototype('object');
		$object->addPrototype('param', new Objects\ObjectParamPrototype('param'));
		
		# MVC Config section, it retuned MVCPrototype(), dont get confused!
		$mvcPrototype = $plugin->addPrototype('mvc', new MVCPrototype('mvc'));
	
		# Child objects
		$mvcPrototype->addPrototype('objects', new Objects\ObjectsPrototype('objects'))
									->addPrototype('object', $object)
									->addPrototype('object', $object);
		# MVC Types
		$mvcPrototype->addPrototype('types', new Services\TypesPrototype('types'))
								->addPrototype('type', new Services\TypePrototype('type'));
		# Services prototypes
		$plugin->addPrototype('services', new Services\ServicesPrototype('services'))
					 ->addPrototype('service', new Services\ServicePrototype('service'))
					 ->addPrototype('proxy', new Services\ServiceProxyPrototype('proxy'))
					 ->addPrototype('object', $object);
		
		# SimpleXML Reader prototype 
		$readerPrototype = new PluginSimpleXMLReaderPrototype();
		
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
	
	/**
	* put your comment there...
	* 
	*/
	public function & getMVCTypes() {
		return $this->getMVC()->getPrototypeInstance('types');
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getServices() {
		return $this->getRootPrototype()->getPrototypeInstance('services');
	}
	
}