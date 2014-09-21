<?php
/**
* 
*/

namespace WPPFW\Services\Dashboard\Ajax;

# Imports
use WPPFW\Services\ServiceBase;

/**
* 
*/
class AjaxService extends ServiceBase {
	
	/**
	* put your comment there...
	* 
	*/
	public function _wp_ajax() {
		# Create Service Front
		$this->createServiceFront(new Proxy());
		# Dispatch
		$this->dispatch();
		# Response back
		$this->response();
		# Must die!
		die();
	}

	/**
	* put your comment there...
	* 
	*/
	public function & start() {
		# Initialize
		$ajaxCallback =& $this->getHookCallback('ajax');
		$accessPoints =& $this->getServiceObjects();
		# Register ajax actions
		foreach ($accessPoints as $index => $accessPoint) {
			# Ajax hook action name
			$hookName = "wp_ajax_{$accessPoint->getName()}";
			# Add hook map.
			$this->hoohMap[$hookName] =& $accessPoints[$index];
			# Bind
			add_action($hookName, $ajaxCallback);
		}
		# Chain
		return $this;
	}

}