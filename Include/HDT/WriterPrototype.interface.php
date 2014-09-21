<?php
/**
* 
* 
*/

namespace WPPFW\HDT;

/**
* 
*/
interface IWriterPrototype {

	/**
	* 
	*/
	public function & load(IHTDDocument & $document, IWriterPrototype & $parent = null);
		
	/**
	* 
	*/
	public function & process();
	
	/**
	* 
	*/
	public function & getDataSource();
	
	/**
	* 
	*/
	public function & getReaderPrototype();
	
	/**
	* 
	*/
	public function & setDataSource($data);
	
	/**
	* 
	*/
	public function & setReaderPrototype(IReaderPrototype & $readerPrototype);
	
}