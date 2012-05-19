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

class Controller_Index extends Core_Controller_Base
{
	public function setMenu()
	{
		$url = Application::getRouter()->getUrl(array('controller'=>'servicehtml','action'=>'view'));
		$menu = new Extension_View_Yui35_Menu();
		$menu->setDirection('horizontal');
		
		
		$sportsModel = new Model_SportsModel();
		$sportsModel->addQuery('select',array('table'=>$sportsModel->getTableName()));
		$sportsCollection = new Core_Model_Adapter_ModelCollection();
		$sportsCollection->getModelCollection($sportsModel);
		   
	    foreach ($sportsCollection->toArray() as $s)
	    { 
	    	$menu->addLink('sport_'.$s['sports_id'],array('content'=>$s['name_of_sport']));
	    	$menu->addChild('menu','sport_'.$s['sports_id']); 
	    } 
		 
	    $groupsModel = new Model_GroupsModel();
		$groupsModel->addQuery('select',array('table'=>$groupsModel->getTableName()));
		$groupsCollection = new Core_Model_Adapter_ModelCollection();
		$groupsCollection->getModelCollection($groupsModel);
		  
		foreach ($groupsCollection->toArray() as $g)
		{
			$menu->addLink('group_'.$g['groups_id'],array('content'=>$g['name_of_group'],'attributes'=>array('class'=>'systemServiceLink','servicehtml'=>$url.'&view=View_Frontend_Offer&groups_id='.$g['groups_id'])));
	    	$menu->addChild('sport_'.$g['sports_id_FK'],'group_'.$g['groups_id']); 
		}  
		
		$this->getTemplate()->setMenu($menu);
	}
	
	public function actionIndex()
	{ 
		$this->setMenu();
		$homePageAdmin = new View_Frontend_HomePage(); 
		$this->getTemplate()->setContent($homePageAdmin);  
	}
	
	
	public function actionLogout()
	{ 
		$this->preventTemplateRender();
		 $user = new Core_Auth_User(); 
		 $user->destroy(); 
		 $this->redirect('index', 'index');    
	}
	
	public function actionLogin()
	{
		$this->preventTemplateRender();
		$user = new Model_UserModel();
		
		$isVarsSet = true;
		if(!isset($_POST['username']))
		{
			$user->setValidationError('username', 'Username not set');
			$isVarsSet = false;
		}
		
		if(!isset($_POST['password']))
		{
			$user->setValidationError('password', 'Password not set');
			$isVarsSet = false;
		}
		
		if(!$isVarsSet)
		{
			echo json_encode(array('status'=>'error','errors'=>$user->getValidationErrors()));
			return;
		}
		
		$user->setUserName($_POST['username']);
		$user->setPasswordBeforeSalt($_POST['password']);
		$user->validateFields(array('user_name','password_before_salt'));
		if($user->isValid())
		{
			if(!$user->login())
			{
				echo json_encode(array('status'=>'error','errors'=>$user->getValidationErrors()));
			}
			else 
			{
				$userSession = new Core_Auth_User(); 
				$userSession->setData($user->getData());
				$userStatus = new Model_UserStatusModel(); 
				$userStatus->load($user->getUserStatusIdFK()); 
				$userSession->isAuth(true);
				$userSession->setRole($userStatus->getStatusName()); 
				echo json_encode(array('status'=>'ok'));
			}
		}
		else 
		{
			echo json_encode(array('status'=>'error','errors'=>$user->getValidationErrors()));
		} 
	}
	
	public function actionRegistration()
	{
		$this->preventTemplateRender();
		$user = new Model_UserModel();
		$isVarsSet = true;
		if(!isset($_POST['user_nameReg']))
		{
			$user->setValidationError('username', 'Username not set');
			$isVarsSet = false;
		}
		
		if(!isset($_POST['passwordReg']))
		{
			$user->setValidationError('password', 'Password not set');
			$isVarsSet = false;
		}
		
		if(!isset($_POST['first_name']))
		{
			$user->setValidationError('first_name', 'Firstname not set');
			$isVarsSet = false;
		}
		
		if(!isset($_POST['last_name']))
		{
			$user->setValidationError('password', 'Last name not set');
			$isVarsSet = false;
		}
		
		if(!isset($_POST['email']))
		{
			$user->setValidationError('email', 'Email not set');
			$isVarsSet = false;
		}
		
		if(!$isVarsSet)
		{
			echo json_encode(array('status'=>'error','errors'=>$user->getValidationErrors()));
			return false;
		}
		
		$user->setUserName($_POST['user_nameReg']);
		$user->setPasswordBeforeSalt($_POST['passwordReg']);
		$user->setFirstName($_POST['first_name']);
		$user->setLastName($_POST['last_name']);
		$user->setEmail($_POST['email']);
		$user->validateFields(array('user_name','password','first_name','last_name','email'));
		
		if($user->isValid())
		{  
			$user->registration();
			if(!$user->isValid())
			{
				echo json_encode(array('status'=>'error','errors'=>$user->getValidationErrors()));
			}
			else 
			{
				echo json_encode(array('status'=>'ok','message'=>'Registration is complete<br /> You may login now'));
			}
		}
		else 
		{
			echo json_encode(array('status'=>'error','errors'=>$user->getValidationErrors()));
		} 
	}
}