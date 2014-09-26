<?php
/**
* 
*/

namespace WPPFW\MVC\Controller;

# imports
use WPPFW\MVC;
use WPPFW\Obj\IFactory;

/**
* 
*/
abstract class Controller extends Base {
	
	/**
	* put your comment there...
	* 
	* @var MVC\MVCViewParams
	*/
	protected $redirect;
	
	/**
	* put your comment there...
	* 
	*/
	protected function dispatched() {
		# Check if redirected!
		if ($this->redirect) {
			# Get new location URL.
			$location = '';
			# Redirect!
			header("Location: {$location}");
		}
	}

	/**
	* put your comment there...
	* 
	* @param mixed $result
	*/
	public function getResponder(& $result) {
		# Initialize
		$structure =& $this->getStructure();
		$target =& $this->getTarget();
		$serviceManager =& $this->getMVCServiceManager();
		# Getting view class components
		$viewClass[] = '';
		$viewClass[] = $structure->getRootNS()->getNamespace();
		$viewClass[] = $structure->getModule(); # Module(s) namespave
		$viewClass[] = $target->getModule();  # Module name
		$viewClass[] = $structure->getView(); # View(s) Namespace
		$viewClass[] = $target->getView();
		$viewClass[] = implode('', array($target->getView(), $target->getFormat(), $structure->getViewClassId())); # Controller name
		# View class
		$viewClass = implode('\\', $viewClass);
		# Creating view
		$view = new $viewClass($serviceManager, $result);
		# Returning view
		return $view;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $target
	*/
	protected function redirect(MVC\MVCViewParams $target) {
		# Set redirect target
		$this->redirect =& $target;
	}

} # End class
