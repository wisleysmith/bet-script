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

class Controller_Servicehtml extends Core_Controller_Base
{
	public function __construct()
	{
		$this->preventTemplateRender();
	}
	public function actionIndex()
	{
		
	} 

	private function validateView()
	{
		if(!isset( $_REQUEST['view']))
 		{
 			$this->exitWithError('View not set'); 
 		}
 		
		$className = $_REQUEST['view'];
 		//check if request is for view folder
		if(strpos($className, 'View_')!==0)
		{
			$this->exitWithError('View does not existe'); 
		}
 		if(!class_exists($className))
		{
			$this->exitWithError('View does not exist'); 
		}
		
		$user = new Core_Auth_User(); 
		$acl = Application::getAcl(); 
		$role =$user->getRole();
		if($role!='admin'&&$role!='superadmin')
		{
			$acl->addCurrentAsset($_REQUEST['view']);
			$acl->validate();
		}
		
		return $className;
	}
	
 	public function actionView()
 	{  
 		$className = $this->validateView();
 		$class = new $className();
 		
 		try 
 		{ 
 			$html = $class->generateView();
 			$javascript = Core_View_Layout_JavascriptTemplate::singleton()->getJavascript();
 			 
 			if(isset($_REQUEST['raw']))
 			{
 				if($_REQUEST['raw']=='js')
 				{
 					echo $javascript;
 				}
 				else if($_REQUEST['raw']=='html')
 				{
 					echo $html;
 				}
 			}
 			else 
 			{
 				echo json_encode(array('status'=>'ok','html'=>$html,'javascript'=>$javascript));
 			} 
 		} 
 		catch (Exception $e) 
 		{
 			$this->exitWithError('error'); 
			exit;
 		} 
 	} 
 	
 	 
}
