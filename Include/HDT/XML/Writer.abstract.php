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
abstract class XMLWriterPrototype extends HDT\WriterPrototype {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $tagName;
	
	/**
	* put your comment there...
	* 
	* @param mixed $tagName
	* @param IReaderPrototype $readerPrototype
	* @return {XMLWriterPrototype|IReaderPrototype}
	*/
	public function __construct($tagName, HDT\IReaderPrototype & $readerPrototype = null) {
		# HDT Prototype writer
		parent::__construct($readerPrototype);
		# Initialize
		$this->tagName = $tagName;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function getTagName() {
		return $this->tagName;
	}

}
