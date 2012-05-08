<?php
  
/**
 * @copyright   Copyright (c) 2012 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.gnu.org/licenses/gpl-2.0.html
 * @author      Goran Sambolic gsambolic@gmail.com
 *
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */ 

/**
 * Main application class 
 *
 */
class Application 
{ 
	private static $router;
	
	private static $bootstrap;
	
	private static $includePath;
	
	private static $configurationXML;
	
	private static $templates;
	
	private static $activeTemplate;
	  
	private static $applicationPath;
	
	private static $singletons;
	
	private static $acl;
	 
  
	public static function run($bootstrap)
	{   
		$includePaths = dirname(__FILE__);  
	 	
		set_include_path( 
		   $includePaths
		);
		
		spl_autoload_register(array(__CLASS__, 'autoload'));
		 
		self::$applicationPath = $includePaths;
		
		self::$includePath = dirname(__FILE__);  
		
	 	if(!isset($bootstrap))
	 	{
	 		throw new Core_Exceptions("Bootstrap is not implemented");
	 	}
	 	self::runBootstrap($bootstrap);  
		//self::parseConfiguration(Application::getConfigurationXML());  
	    self::displayContent();
	} 
	
	public static function autoload($className)
	{ 
		$pathExploaded = explode("_",$className);   
		$classParsedLocation = "";
		
		$a = 0;
		foreach ($pathExploaded as $p)
		{
			if($a==0)
			{
				$classParsedLocation.= $p;
			}
			else 
			{ 
				$classParsedLocation.= DIRECTORY_SEPARATOR.$p;
			}
			$a++;
		}
		 
		$includePath = get_include_path().DIRECTORY_SEPARATOR.$classParsedLocation.'.php';
		
		if(!file_exists($includePath))
		{ 
			exit("File does not exist:".$includePath);
		}
		 
		require_once $classParsedLocation.".php"; 
	}
	
	public static function getApplicationPath()
	{
		return self::$applicationPath;
	}
	
	private static function runBootstrap($bootstrap)
	{ 
		self::$bootstrap = new $bootstrap();
		
		$classname = 'Core_Config_IApplication';
		if (!self::$bootstrap instanceof $classname) 
		{
			throw new Core_Exceptions("Bootstrap is not implementing Core_Config_IApplication interface");
		} 
		self::$bootstrap->run();
		self::$acl = self::$bootstrap->getAcl();  
		self::$acl->validate();
		self::$templates = self::$bootstrap->getTemplates();
		self::setActiveTemplate(self::$bootstrap->getActiveTemplate());
		self::$router = self::$bootstrap->getRouter();  
		
	}  
	
	public static function getAcl()
	{
		return self::$acl;
	}
	
	 
 	public static function setErrorReporting($value)
 	{
 		error_reporting($value);
 	}
 
 	public static function iniSet($option,$value)
 	{
 		ini_set($option, $value); 
 	} 
 	 
 	/**
 	private static function getConfigurationXML()
 	{ 
 		if(isset(self::$configurationXML))
 		{
 			return self::$configurationXML;
 		}
 		$configurationPath = self::$includePath.DIRECTORY_SEPARATOR."configuration.xml";
 	 
 		if($xmlFile = file_exists($configurationPath))
 		{ 
 			return	self::$configurationXML = simplexml_load_file($configurationPath);
 		}  
 		throw new Core_Exceptions("Configuration file does not exist");
 	}
 	
 	private static function parseConfiguration($xml)
 	{
 		new Core_Config_ProcessConfiguration($xml);
 	}
 	*/
 	public static function getIncludePath()
 	{
 		return self::$includePath;
 	}
 	
 	private static function setTemplates($templates)
 	{
 		self::$templates = $templates;
 	}
 	
	public static function getTemplates()
 	{
 		return self::$templates;
 	}
 	
 	private static function setActiveTemplate($name)
 	{
 		if(!isset(self::$templates[$name]))
 		{
 			throw new Core_Exceptions("Template does not exit");  
 		}
 		self::$activeTemplate = $name ;
 	} 
	
 	public static function getActiveTemplate()
 	{
 		if(!isset(self::$activeTemplate))
 		{
 			throw new Core_Exceptions("Template does not exit");  
 		}
 		return self::$activeTemplate;
 	}
 	
 	public static function displayContent()
 	{ 
 		$action = self::getRouter()->getActionMethod(); 
		$controllerClassName = self::getRouter()->getControllerClass();
 		$controllerInstance = new $controllerClassName(); 
 		$controllerInstance->setActiveTemplate(self::getActiveTemplate());
 		$controllerInstance->setTemplates(self::getTemplates()); 
 		$controllerInstance->run();
		$controllerInstance->$action();
		$controllerInstance->render(); 
 	}
 	 
	public static function getRouter()
	{
		return self::$router;
	}
	
	public static function getAction()
	{
		return self::$router->getAction();
	}
	
	public static function getController()
	{
		return self::$router->getController();
	} 
	  
	public static function getSingleton($class)
	{
		if(isset(self::$singletons[$class]))
		{
			return self::$singletons[$class];
		} 
		return self::$singletons[$class] = new $class;
	}   
	
	public static function getBaseRelativeUrl()
	{
		$url = $_SERVER['PHP_SELF'];
		$url = str_replace('/index.php', '', $url);
		return $url;
	}
}
 
?> 
 