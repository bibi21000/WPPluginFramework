<?php
/**
* 
*/

namespace WPPFW\MVC;

/**
* 
*/
interface IMVCServiceManager {
	
	/**
	* 
	*/
	public function & getInput();
	
	/**
	* 
	*/
	public function & getForm($name = null);
	
	/**
	* 
	*/
	public function & getModel($name = null);
	
	/**
	* 
	*/
	public function & getTable($name = null);
}