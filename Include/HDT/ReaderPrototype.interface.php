<?php
/**
* 
* 
*/

namespace WPPFW\HDT;

/**
* 
*/
interface IReaderPrototype {
	
	/**
	* 
	*/
	public function & query($prototypeName, IWriterPrototype & $parent, IWriterPrototype & $writer);
	
}
