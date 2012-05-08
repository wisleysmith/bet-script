<?php
/**
* @copyright Copyright (c) 2011 Oxidian d.o.o (http://www.oxidian.hr)
* @license commercial
*/
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "1"); 
require_once "application/Application.php"; 
Application::run('Bootstrap');
