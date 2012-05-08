<?php 
abstract class Core_View_Layout_Template extends Core_Event_Dispatcher
{  
	private $views = array();
	private $registerForJavascipt; 
	private $id;
	private static $elementNumber = 0;
	//if is set default override is made
	private $pathJavscriptTemplateFile = null;
	//if is set default override is made
	private $pathTemplateFile = null;
	private $eventListners = array();
	private $prependHtml='';
	private	$appendHtml='';
	private $prependJavascript='';
	private $appendJavascript='';
	 
	
	public function setAppendHtml($html)
	{
		$this->appendHtml = $html;
	}
	
	public function getPrependHtml()
	{
		return $this->prependHtml;
	}
	
	public function getAppendHtml()
	{
		return $this->appendHtml;
	}
	
	public function setPrependHtml($html)
	{
		$this->prependHtml = $html;
	}
	
	public function setPrependJavscript($javascript)
	{
		$this->prependJavascript = $javascript;
	}
	
	public function setAppendJavascript($javascript)
	{
		$this->appendJavascript = $javascript;
	}

	public function getPrependJavscript()
	{
		return $this->prependJavascript;
	}
	
	public function getAppendJavascript()
	{
		return $this->appendJavascript;
	}
	public function getPathJavscriptTemplateFile()
	{
		return $this->pathJavscriptTemplateFile;
	}

	public function setPathTemplateFile($pathTemplateFile)
	{
		$this->pathTemplateFile = $pathTemplateFile;
	}
	
	public function getPathTemplateFile()
	{
		return $this->pathTemplateFile;
	}
	
	public function getId()
	{  
		if(!isset($this->id)) 
		{
			return $this->setId("default");
		}
		return $this->id;
	}
	
	public function setId($id)
	{
		if(isset($this->id))
		{
			throw new Core_Exceptions("Id already exist");
		}
		self::$elementNumber = self::$elementNumber+1;
		return $this->id = $id."_core_".self::$elementNumber.time();
	} 
  
	public function getViews()
	{
		return $this->views;
	} 
	
	public function generateView()
	{  
		$this->dispatchEvent('onGenerateViewBefore'); 
		$content = "";
		
		if(!file_exists(Application::getIncludePath().DIRECTORY_SEPARATOR.$this->pathTemplateFile()))
		{
			return "";
		}
		ob_start ();
		include $this->pathTemplateFile();
		$content = ob_get_contents(); 
		ob_end_clean();  
		$this->appendJavascriptAfterViewCreation();
		$this->dispatchEvent('onGenerateViewAfter');  
		return $this->getPrependHtml().$content.$this->getAppendHtml();
	}
	
	public function generateJavascript()
	{
		$this->dispatchEvent('onGenerateJavascriptBefore'); 
		$content = "";  
		if(!file_exists(Application::getIncludePath().DIRECTORY_SEPARATOR.$this->pathJavscriptTemplateFile()))
		{ 
			return "";
		}
		ob_start ();
		include $this->pathJavscriptTemplateFile();
		$content = ob_get_contents(); 
		ob_end_clean();  
		$this->dispatchEvent('onGenerateJavascriptAfter');
		return $this->getPrependJavscript().$content.$this->getAppendJavascript();
	}
	 
	protected function pathTemplateFile()
	{
		if(isset($this->pathTemplateFile))
		{
			return $this->pathTemplateFile;
		}
		
		$filePathArray = explode('_' , get_class($this));
		$templateName = strtolower($filePathArray[sizeof($filePathArray)-1]);
		$templatePathFromClass = DIRECTORY_SEPARATOR.'templates'. DIRECTORY_SEPARATOR.$templateName.'.php';
	    unset($filePathArray[sizeof($filePathArray)-1]);
		$pathToClass = implode("/", $filePathArray);
		return  $pathToClass.$templatePathFromClass; 
	}  
	
	protected function pathJavscriptTemplateFile()
	{ 
		if(isset($this->pathJavscriptTemplateFile))
		{
			return $this->pathJavscriptTemplateFile;
		}
		
		$filePathArray = explode('_' , get_class($this));
		$templateName = strtolower($filePathArray[sizeof($filePathArray)-1]);
		$templatePathFromClass = DIRECTORY_SEPARATOR.'templates'. DIRECTORY_SEPARATOR.$templateName.'.js.php';
	    unset($filePathArray[sizeof($filePathArray)-1]);
		$pathToClass = implode("/", $filePathArray);
		return  $pathToClass.$templatePathFromClass; 
	}  
	
	public function registerForJavascript($array)
	{
		$returnValue = '';
		foreach ($array as $key => $a)
		{
			$this->setJavascriptValue($key,$a);
		}
		
		if(isset($array['id']))
		{
			$returnValue.= ' id="'.$array['id'].'"';
		}
		
		if(isset($array['class']))
		{
			$returnValue.= ' class="'.$array['class'].'"';
		}
		return $returnValue;
	} 
	
	public function setJavascriptValue($key,$value)
	{
		$this->registerForJavascript[$key]=$value;
	}
	
	/**
	 * 
	 *
	public function getJavascriptValue($key)
	{
		$this->registerForJavascript[$key];
	}
	
	public function generateJson()
	{
		$this->generateView();
		return json_encode($this->registerForJavascript);
	}
	
	public function displayJson()
	{
		echo $this->generateJson();
	}
	*
	*
	
	
	public function getJavascriptValues()
	{
		return $this->registerForJavascript;
	}
 */
	/** 
	 * on echo of template instance this create html and js code.
	 * order is important. First is setup html code then js.
	 * This order enables to javascript be generated from child to parent.
	 * If you wont to change order from parent to child then first create javascript and after 
	 * create html view. 
	 * Reason is in if html view is generated before javascript, childs are created and childs of JS are also created.
	 * If you create first javascript and then view, javscript from parent is generated first and then from childs.
	 * Notice that most top level child if call Core_View_Layout_JavascriptTemplate::singleton(); in html template
	 * will not have javascript from js template. So in top most child that calls Core_View_Layout_JavascriptTemplate::singleton()
	 * must be setup manually. 
	 * This is because this view is created before javascript, 
	 */
	public function __toString()
	{  
		$view = $this->generateView();   
		return $view;
	}   
	
	private function appendJavascriptAfterViewCreation()
	{
		$singletonInstance = Core_View_Layout_JavascriptTemplate::singleton();  
		$singletonInstance->appendJavascript($this->generateJavascript()); 
	}
	
	public function getHtmlIds($name,$withIdentifier = false)
	{
		if($withIdentifier)
		{
			return '#'.$name.'_'.$this->getId(); 
		}
		return $name.'_'.$this->getId(); 
	} 
}

?>