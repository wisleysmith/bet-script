<?php

// sql injection prevention on load() method in models
// template generation, if view not set js can be created
// service html view has option for generation of raw js or html file without json.
// view validation in servicehtml moved to new method validateView;
// multi javascript support
// setting session id moved from session Object to Applicction
// session object declared abstract
// menu component created, menu YUI 3 widget possible to load View classes
// service js creator file added, WidgetLoader
// session with files added

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
	
  	const SESSION_TYPE_SERVER = "server";
	const SESSION_TYPE_DB = "database";
	const SESSION_TYPE_FILE = "file";
	
	private static $router;
	
	private static $serviceKey;
	
	private static $bootstrap;
	
	private static $includePath;
	  
	private static $templates;
	
	private static $activeTemplate;
	  
	private static $applicationPath;
	
	private static $singletons;
	
	private static $acl;
	
	private static $sessionType = Application::SESSION_TYPE_SERVER;
	 
	public static function setServiceKey($key)
	{
		self::$serviceKey = $key;
	}
	
	public static function getServiceKey()
	{
		return $this->serviceKey;
	}
	
	public static function setSessionType($sessionType)
	{
		self::$sessionType = $sessionType;
	}
	
	public static function getSessionType()
	{
		return self::$sessionType;
	}
	
	public static function run($bootstrap)
	{     
		$includePaths = dirname(__FILE__);  
	 	
		set_include_path( 
		   $includePaths
		);
		
		spl_autoload_register(array(__CLASS__, 'autoload'));
		
		Core_Session_Object::setSessionId(); 
		 
		self::$applicationPath = $includePaths;
		
		self::$includePath = dirname(__FILE__);  
		
	 	if(!isset($bootstrap))
	 	{
	 		throw new Core_Exceptions("Bootstrap is not implemented");
	 	}
	 	self::runBootstrap($bootstrap);   
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
		self::setSessionHandler(self::$bootstrap->getSessionTypeFile()); 
		self::$bootstrap->run(); 
		self::$acl = self::$bootstrap->getAcl();  
		self::$acl->validate();
		self::$templates = self::$bootstrap->getTemplates();
		self::setActiveTemplate(self::$bootstrap->getActiveTemplate());
		self::$router = self::$bootstrap->getRouter();  
	}  
	
	public static function setSessionHandler($sessionType)
	{
		if(Application::SESSION_TYPE_FILE == $sessionType)
		{
			$sessionHandler = new Core_Session_HandlerTypeFile();
		} 
		else 
		{
			return;
		}
		
		session_set_save_handler
		(
		    array($sessionHandler, 'open'),
		    array($sessionHandler, 'close'),
		    array($sessionHandler, 'read'),
		    array($sessionHandler, 'write'),
		    array($sessionHandler, 'destroy'),
		    array($sessionHandler, 'gc')
		);
		
		// the following prevents unexpected effects when using objects as save handlers
		register_shutdown_function('session_write_close'); 
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
	
	public static function getBaseUrl()
	{
		$url = $_SERVER['HTTP_HOST'];
		$url = 'http://'.$url.self::getBaseRelativeUrl();
		return $url;
	}
} 
?> 
 