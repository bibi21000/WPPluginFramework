<?php
/**
* 
*/

namespace WPPFW\HDT;

/**
* 
*/
abstract class WriterPrototype implements IWriterPrototype {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $result = null;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $dataSource = null;
	
	/**
	* put your comment there...
	* 
	* @var IHTDDocument
	*/
	protected $document = null;

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $instances = array();
	
	/**
	* put your comment there...
	* 
	* @var IWriterPrototype
	*/
	protected $parent = null;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $prototypes = array();
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $readerPrototype = null;

	/**
	* put your comment there...
	* 
	* @param IReaderPrototype $readerPrototype
	* @return {WriterPrototype|IReaderPrototype}
	*/
	public function __construct(IReaderPrototype & $readerPrototype = null) {
		# INitialize reader prototype
		$this->readerPrototype =& $readerPrototype;
		# Model initialization
		$this->initializeModel();
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	* @param IWriterPrototype $prototype
	* @return WriterPrototype
	*/
	public function & addPrototypeAndChain($name, IWriterPrototype $prototype) {
		# Add prototype
		$this->prototypes[$name] =& $prototype;
		# Chaining
		return $this;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	* @param IWriterPrototype $prototype
	* @return WriterPrototype
	*/
	public function & addPrototype($name, IWriterPrototype $prototype) {
		# Add prototype
		$this->prototypes[$name] =& $prototype;
		# Chaining
		return $prototype;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getDataSource() {
		return $this->dataSource;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getDocument() {
		return $this->document;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getInstances() {
		return $this->instances;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getParent() {
		return $this->parent;
	}
	
	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getPrototype($name) {
		# CHeck existance
		if (!isset($this->prototypes[$name])) {
			####
		}
		# Returns
		return $this->prototypes[$name];
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getPrototypeInstances($name) {
		return $this->instances[$name];
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getReaderPrototype() {
		return $this->readerPrototype;
	}
  
	/**
	* put your comment there...
	* 
	*/
	public function & getResult() {
		return $this->result;
	}
	
	/**
	* put your comment there...
	* 
	*/
	protected function initializeModel() {;}
	
	/**
	* put your comment there...
	* 
	* @param IHTDDocument $document
	* @param {IHTDDocument|IWriterPrototype} $parent
	* @return {IHTDDocument|IWriterPrototype}
	*/
	public function & load(IHTDDocument & $document, IWriterPrototype & $parent = null) {
		# Initialize object
		$this->document =& $document;
		$this->parent =& $parent;
		# Initialize
		$prototypes =& $this->prototypes;
		# Get all prototypes
		foreach ($prototypes as $prototypeName => $prototype) {
			/**
			* put your comment there...
			* 
			* @var IReaderPrototype
			*/
			$readerPrototype = 	$prototype->getReaderPrototype() ?
													$prototype->getReaderPrototype() :
													$document->getDefaultReaderPrototype();
			# Read data. Create write prototype instances only if
			# there is data available (STATIC call on tHE PROTOTYPE that should not BINDED as Instances below!!)
			$dataList = $readerPrototype->query($prototypeName, $this, $prototype);
			$dataList = !empty($dataList) ? $dataList : array();
			# Create instance for every data record available
			foreach ($dataList as $dataSource) {
				/**
				* Create prototype ionstance
				* 
				* @var IWriterPrototype
				*/
				$prototypeInstance = clone $prototype;
				/**
				* Create Reader prototype instance
				* 
				* @var IReaderPrototype
				*/
				$readerPrototypeInstance = clone $readerPrototype;
				$readerPrototypeInstance->bind($this, $prototypeInstance);
				# Set Writer Data source
				$prototypeInstance->setDataSource($dataSource)
				# Set readerprototype
													->setReaderPrototype($readerPrototypeInstance)
				# load prototype
													->load($document, $this);
				# Add to prototypes list.
				$this->instances[$prototypeName][] = $prototypeInstance;
			}
		}
	}

	/**
	* put your comment there...
	* 
	* @param IHTDDocument $document
	* @param mixed $data
	* @param IWriterPrototype $parent
	* @return {{IHTDDocument|IWriterPrototype}
	*/
	public function & loadWithData(IHTDDocument & $document, & $data, IWriterPrototype & $parent = null) {
		# Set data
		$this->setDataSource($data);
		# Load
		return $this->load($document, $parent);
	}
		
	/**
	* put your comment there...
	* 
	*/
	public function & process() {
		# Process In
		$this->processIn();
		# Process Plugged prototype
		$this->processPrototypes();
		# Process Out
		$this->processOut();
		# chain
		return $this;
	}

	/**
	* put your comment there...
	* 
	*/
	public function processIn(& $pipe) {;}
	
	/**
	* put your comment there...
	* 
	*/
	public function processOut(& $pipe) {;}
	
	/**
	* put your comment there...
	* 
	* @param mixed $layerName
	* @param mixed $pipe
	*/
	protected function & processPrototypes($layerName, & $pipe) {
		# Initialize
		$instances =& $this->getInstances();
		# Get all prototypes instances
		foreach ($instances as $prototypeName => $PrototypeInstances) {
			foreach ($PrototypeInstances as $instance) {
				# Process instance
				$instance->scan($layerName, $pipe);
			}
		}
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & removePrototype($name) {
		# Get prototype
		$prototype =& $this->getPrototype($name);
		# Remove it
		unset($this->prototypes[$name]);
		# return prototype
		return $prototype;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $data
	*/
	public function & setDataSource($dataSource) {
		# Set
		$this->dataSource =& $dataSource;
		# Chain
		return $this;
	}

	/**
	* put your comment there...
	* 
	* @param IReaderPrototype $readerPrototype
	* @return {IReaderPrototype|WriterPrototype}
	*/
	public function & setReaderPrototype(IReaderPrototype $readerPrototype) {
		# Set
		$this->readerPrototype =& $readerPrototype;
		# Chain
		return $this;
	}

}