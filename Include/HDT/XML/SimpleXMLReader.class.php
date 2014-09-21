<?php
/**
* 
*/

namespace WPPFW\HDT\XML;

# Imports
use WPPFW\HDT;

/**
* 
*/
class SimpleXMLReaderPrototype extends HDT\ReaderPrototype {

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $namespaces;
	
	/**
	* put your comment there...
	* 
	* @param mixed $prefix
	* @param mixed $url
	*/
	public function & addNamespace($prefix, $uri) {
		# Register namespace
		$this->namespaces[] = array($prefix, $uri);
		# Chain
		return $this;
	}

	/**
	* put your comment there...
	* 
	* @param \SimpleXMLElement $node
	* @return \SimpleXMLElement
	*/
	public function & getAttributesArray() {
		# Initialize
		$writer =& $this->getWriter();
		$node =& $writer->getDataSource();
		# Cast to array
		$attributesArray = (array) $node->attributes();
		# Get array values
		return $attributesArray['@attributes'];
	}

	/**
	* put your comment there...
	* 
	* @param mixed $prototypeName
	* @param IWriterPrototype $parent
	* @param {IWriterPrototype|IWriterPrototype} $writer
	* @return {IWriterPrototype|IWriterPrototype}
	*/
	public function & query($prototypeName, HDT\IWriterPrototype & $parent, HDT\IWriterPrototype & $writer) {
		# Initialize
		$tagName = $writer->getTagName();
		/**
		* put your comment there...
		* 
		* @var SimpleXMLElement
		*/
		$parentNode =& $parent->getDataSource();
		# Register namespace
		$parentNode->registerXPathNamespace($this->namespaces[0][0], $this->namespaces[0][1]);
		# Query
		$dataList = $parentNode->xpath("{$tagName}");
		# Return data list
		return $dataList;
	}

}