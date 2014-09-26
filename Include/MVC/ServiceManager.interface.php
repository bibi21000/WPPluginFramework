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
	public function & getController();
	
	/**
	* 
	*/
	public function & getFactory();
	
	/**
	* 
	*/
	public function & getForm($name = null);

	/**
	* 
	*/
	public function & getInput();
	
	/**
	* 
	*/
	public function & getModel($name = null);
	
	/**
	* 
	*/
	public function & getNames();
	
	/**
	* 
	*/
	public function & getRouter();
	
	/**
	* 
	*/
	public function & getStructure();
	
	/**
	* 
	*/
	public function & getTable($name = null);
	
	/**
	* 
	*/
	public function & getTarget();

}