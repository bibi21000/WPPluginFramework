<?php
/**
* 
*/

namespace WPPFW\Services\Dashboard\Menu;

# Imports
use WPPFW\Services;

/**
* 
*/
class Service implements Services\IService {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $hoohMap = array();
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $menuPages;
	
	/**
	* put your comment there...
	* 
	* @var Services\IServiceFrontFactory
	*/
	protected $serviceFront;
	
	/**
	* put your comment there...
	* 
	* @param Services\IServiceFrontFactory $serviceFront
	* @param mixed $menuPages
	* @return Service
	*/
	public function __construct(Services\IServiceFrontFactory & $serviceFront, $menuPages) {
		# Initialize
		$this->serviceFront =& $serviceFront;
		$this->menuPages =& $menuPages;
	}

	/**
	* put your comment there...
	* 
	*/
	public function _wp_addMenu() {
		# Initialize
		$menuCallback = array($this, '_wp_menuCallback');
		$loadCallback = array($this, '_wp_pageLoad');
		# Add all menu pages
		foreach ($this->getMenuPages() as $menuPage) {
			# Add menu item
			$hookSlug = $menuPage->add($menuCallback)->getHookSlug();
			# Bind to page load event
			$loadHook = "load-{$hookSlug}";
			add_action($loadHook, $loadCallback);
			# Add to map
			$this->hoohMap[$loadHook] = $menuPage;
		}
		return;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function _wp_menuCallback() {
		echo $this->getServiceFront()->getResponse();
	}
  
  /**
  * put your comment there...
  * 
  */
  public function _wp_pageLoad() {
  	# Initialize
  	$loadActionName = current_filter();
  	$serviceFront =& $this->getServiceFront();
		# Load service front + exchange service front with the returned one
		$this->serviceFront = $serviceFront->load($this->hoohMap[$loadActionName]);
  }

	/**
	* put your comment there...
	* 
	*/
	public function & getMenuPages() {
		return $this->menuPages;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getServiceFront() {
		return $this->serviceFront;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & start() {
		# Start service
		add_action('admin_menu', array($this, '_wp_addMenu'));
		# Chains
		return $this;
	}
	
}  # End class
