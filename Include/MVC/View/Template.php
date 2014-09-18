<?php
/**
* 
*/

namespace WPPFW\MVC\View;

/**
* 
*/
abstract class TemplateView extends Base {
	
	/**
	* put your comment there...
	* 
	*/
	public function __toString() {
		# Initialize
		$target =& $this->getTarget();
		$structure =& $this->getStructure();
		$namespace =& $structure->getRootNS();
		# Use Action name as layout or use default if overrided!
		$layoutFile = $target->getLayout() ? $target->getLayout() : $target->getAction();
		$layoutExtension = strtolower($target->getFormat());
		# Layout paht compoennet
		$layoutPath[] = $namespace->getPath();
		$layoutPath[] = $structure->getModule();
		$layoutPath[] = $target->getModule();
		$layoutPath[] = $structure->getView();
		$layoutPath[] = $target->getView();
		$layoutPath[] = 'Templates';
		$layoutPath[] = "{$layoutFile}.{$layoutExtension}"; # Layout file
		# Layout file path
		$layoutPath = implode(DIRECTORY_SEPARATOR, $layoutPath);
		# Get any vars ready before rendering
		$this->render();
		# Find template file
		ob_start();
		require $layoutPath;
		$content = ob_get_clean();
		# Return content
		return $content;
	}

	/**
	* put your comment there...
	* 
	*/
	protected function render() {;}
	
}