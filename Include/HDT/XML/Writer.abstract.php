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
		# Initialize
		$this->tagName = $tagName;
		# HDT Prototype writer
		parent::__construct($readerPrototype);
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function getTagName() {
		return $this->tagName;
	}

}
