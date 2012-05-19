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



class Bootstrap implements Core_Config_IApplication
{  
	private $router; 
	
	public function run()
	{   
		 
		$user = new Core_Auth_User();
		 
		if($user->getRole()===null)
		{
			$user->setRole('guest');
		};
		 
		Core_View_Layout_JavascriptTemplate::singleton()->setCurrentJsFramework(Core_View_Layout_JavascriptTemplate::YUI);
		$this->router = new Core_Router_Route(); 
		$sql = new Core_Model_Connection_MySql('localhost','','','');
		$queriesTemplate = new Extension_Core_Model_Template_MySqlQueries();
		Core_Model_Adapter_Sql::setSqlConnection($sql);
		Core_Model_Adapter_Sql::setSqlTemplate($queriesTemplate);
	} 
	
	public function getTemplates()
	{ 
		return array(
			'default'=>'View_Layout_Main',
			'modelgenerator'=>'View_ModelGenerator_Index',
			'admin'=>'View_Layout_Admin'
		); 
	} 
	 
	public function getActiveTemplate()
	{ 
		if($this->getRouter()->getController()=='modelgenerator')
		{ 
			return 'modelgenerator';
		}
		else
		{
			return 'admin';
		}
		return 'default';
	}  
	
	public function getRouter()
	{
		return $this->router;
	} 
	
	public function getAcl()
	{ 
		 $acl = new Core_Acl_Controller();
		 $acl->addRole('guest');
		 $acl->addRoleAsset('guest','index_login'); 
		 $acl->addRoleAsset('guest','index_index');
		  
		 $acl->addRoleAsset('guest', 'servicejson_login'); 
		 $acl->addRoleAsset('guest', 'servicejson_registration'); 
		 
		 $acl->addRoleAsset('guest','admin_index');
		 $acl->addRoleAsset('guest','index_frontend');
		 $acl->addRoleAsset('guest','index_registration');
		 $acl->addRoleAsset('guest', 'servicehtml_view');  
		 $acl->addRoleAsset('guest', 'View_Frontend_Offer'); 
		 $acl->addRoleAsset('guest', 'View_Frontend_WidgetsLoader');
		 $acl->addRoleAsset('guest', 'View_Frontend_Widgets_OfferTableEvents');
		 $acl->addRoleAsset('guest', 'View_Frontend_MenuContent'); 
		 $acl->addRoleAsset('guest', 'View_Frontend_Widgets_Ticket');
		 
		 $acl->addRoleAsset('admin', 'modelgenerator_index'); 
		    
		 $acl->addRole('user','guest');
		 $acl->addRoleAsset('user','index_logout'); 
		 $acl->addRoleAsset('guest', 'servicejson_logout'); 
		 $acl->addRoleAsset('user', 'Model_PlaceBetModel_insert');
		 $acl->addRoleAsset('user', 'View_Frontend_UserBets'); 
		 $acl->addRoleAsset('user', 'View_Frontend_UserBank'); 
		 $acl->addRoleAsset('user', 'View_Frontend_UserBetSlip');  
		 $acl->addRoleAsset('user', 'servicejson_model');
		 $acl->addRoleAsset('user', 'servicejson_modelcollection');
		 $acl->addRoleAsset('user', 'Model_TransactionModel_getTransactionsByUser');
		 $acl->addRoleAsset('user', 'Model_BetSlipModel_getBetSlipsTransactionByUser');
		 
		 $acl->addRole('admin','user'); 
		 $acl->addRole('superadmin','admin');
		 
		 $user = new Core_Auth_User(); 
		 $role = $user->getRole(); 
		 $acl->addCurrentRole($role);   
		 
		 if($role=='admin'||$role=='superadmin')
		 {
		 	//there is no restriction;
		 }
		 else if($role=='guest'||$role=='user')
		 { 
			 $acl->addCurrentAsset($this->getRouter()->getController().'_'.$this->getRouter()->getAction());
		 } 
		 
		 return $acl;
	}
	 
	public function getSessionTypeFile()
	{
		return Application::SESSION_TYPE_SERVER;
	}
}