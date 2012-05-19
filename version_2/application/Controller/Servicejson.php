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

class Controller_Servicejson extends Core_Controller_Base
{
	private $operators = array(
		'and' => ' and ',
		'or' => ' or '
	); 
	
	private $comparison = array(
		'=' => ' = ',
		'>' => '>',
		'<' => '<'
	);
	
	public function __construct()
	{
		$this->preventTemplateRender();
	} 
	 
	//service that calls model method to get json  
	//no use for now
	public function actionMethod()
	{ 
		$this->exitWithError('not in user');
		$requestedData = $this->validateModel();
		$className = $requestedData['class'];
		$method = $requestedData['method'];
		$model = new $className(); 
		
		if(!($result = $model->$method()))
		{
			echo json_encode(array('status'=>'error','errors'=>$model->getValidationErrors()));
		}
		else 
		{
			echo json_encode(array('status'=>'ok','data'=>$result));
		};
	}
	
	public function actionModel()
	{ 	 
		$requestedData = $this->validateModel();
		
		$paramModel = $_REQUEST['model'];
		$className = $requestedData['class'];
		$method = $requestedData['method'];
		$model = new $className();

		if($method===null)
		{
			$this->exitWithError('Request method must be set');
		}
		
		$model->setData($paramModel[$className]);
 		  
		if($method=='delete')
		{
			$result = $model->delete();
		}
		
		if($method=='insert')
		{
			$result = $model->insert();
		}
		
		if($method=='update')
		{
			$result = $model->update();
		}
		 
		if($method=='load')
		{
			$data = array();
			foreach ($paramModel[$className]['filter'] as $key=>$param)
			{
				$data[$key] = $param;
			} 
			$result = $model->load($data);
		}
		
		if(!$model->isValid())
		{
			echo json_encode(array('status'=>'error','errors'=>$model->getValidationErrors()));
		}
		else 
		{
			echo json_encode(array('status'=>'ok','data'=>$model->getServiceData()));
		};
	}  
	
	public function actionModelcollection()
	{    
		$requestedData = $this->validateModel();
		$paramModel = $_REQUEST['model'];  
		 
		
		$className = $requestedData['class'];
		$method = $requestedData['method'];
		$model = new $className();
		$where='';
		$divader='';  
		 
		if($method!==null)
		{
			$model->$method();
		}
		else 
		{
			$model->addQuery('select',array('table'=>$model->getTableName()));
		} 
		
		if(isset($paramModel[$className]['filter']))
		{
			$where = $this->parseFilter($paramModel[$className]['filter'],$model,$paramModel[$className]['filterGroupOperators']);
		} 
		
		if($where!='')
		{
			$model->addQuery('where',array('where_condition'=>$where));
		} 
		
		$sortBy = 'DESC';
		if(isset($paramModel[$className]['sortBy']))
		{
			if($paramModel[$className]['sortBy']=='ASC')
			{
				$sortBy = 'ASC';
			}
		}
		
		$model->addQuery('order',array('order'=>implode($model->getPrimaryKeys(),",").' '.$sortBy));
		
		if(isset($paramModel[$className]['limitStart']))
		{
			$start = (int)$paramModel[$className]['limitStart'];
			$end = (int)$paramModel[$className]['limitEnd'];
			
			if($start!=0||$end!=0)
			{  
				$limit = $start;
				if($end!=0)
				{
					$limit = $start.','.$end;
				} 
				 
				$model->addQuery('limit',array('limit'=>$limit));   
			}
		}
		
		$modelCollection = new Core_Model_Adapter_ModelCollection();
		$result = $modelCollection->getModelCollection($model,false); 
	 	$countResult = null;
	 
		if(isset($paramModel['count']))
		{  
	 		$countResult = $model->count();
		}
		  
	 	if(!$model->isValid())
		{
			echo json_encode(array('status'=>'error','errors'=>$modelCollection->modelValidationErrors()));
		}
		else 
		{
			$dataForJson = array('status'=>'ok','data'=>$modelCollection->toServiceArray());
			if(isset($countResult))
			{
				$dataForJson['count'] = $countResult;
			}
			echo json_encode($dataForJson);
		} 
	}  
	
	private function validateModel()
	{  
		if(!isset($_REQUEST['model']))
		{ 
			$this->exitWithError('No model set');
		}
		 
		if(sizeof($_REQUEST['model'])>1)
		{ 
			$this->exitWithError('Only one model allowed');
		}
		
		$className = key($_REQUEST['model']);
		
		//check if request is for view folder
		if(strpos($className, 'Model_')!==0)
		{
			$this->exitWithError('Model does not exist'); 
			exit;
		}
		
		if(!class_exists($className))
		{ 
			$this->exitWithError('Model does not exist');
		}
		
		if(!isset($_REQUEST['method']))
		{
			//request method does not exist default it to select
			if(!isset($_REQUEST['model'][$className]['method']))
			{
				$method = null;
			}
			else 
			{
				$method = $_REQUEST['model'][$className]['method'];
			}
		}
		else 
		{
			$method = $_REQUEST['method'];
		}
		 
		if($method !=null)
		{ 
			if(!method_exists($className,$method))
			{
				
			echo $className.' -- '.$method;
				$this->exitWithError('Request method does not exist');
			}
		}
		
		$user = new Core_Auth_User(); 
		$acl = Application::getAcl(); 
		$role =$user->getRole();
		if($role!='admin'&&$role!='superadmin')
		{
			$acl->addCurrentAsset($className.'_'.$method);
			$acl->validate();
		} 
		 
		return array('class'=>$className,'method'=>$method);
	}
	
	private function parseFilter($filters,$model,$groupOperators)
	{
		$filterGroupOperators = (array)json_decode(stripslashes ($groupOperators));
		$filtersParsed = array();
		foreach ($filters as $key=>$f)
		{
			if(isset($f['value']))
			{
				if(!empty($f['value']))
				{
					$dataArray = (array)json_decode(stripslashes ($f['data'])); 
					$dataArray['value'] = $f['value'];  
					$filtersParsed[$dataArray['group']][]=$dataArray; 
				}
			}
		}  
		 
		if(empty($filtersParsed))
		{
			return '';
		}
		
		$firstIteration =true;
		$queryString ='';
		foreach($filtersParsed as $key=>$f)
		{ 
			if($firstIteration == false)
			{  
				if(!isset($filterGroupOperators[$key]))
				{ 
					$this->exitWithError('Group not set');
				}
				$operator = $filterGroupOperators[$key];
				
				if(!$this->getOperators($operator))
				{
					$this->exitWithError('Operator does not exist');
				}
				
				$queryString.= ' '.$this->getOperators($operator).' ';
			};
			$queryString.= '(';
			for($i=0;$i<sizeof($f);$i++)
			{
				
				if(!$this->getOperators($f[$i]['operator']))
				{
					$this->exitWithError('Operator does not exist');
				} 
				
				if(!isset($f[$i]['name']))
				{
					$this->exitWithError('Name not set');
				}
				 
				if(!isset($f[$i]['value']))
				{
					$this->exitWithError('Value not set');
				}
				
				if(!$model->isDataExist($f[$i]['name']))
				{
					$this->exitWithError('Name does not exist');
				}
				
				if(!$this->getComparison($f[$i]['comparison']))
				{
					$this->exitWithError('Comaprison not exist');
				}
				
				$model->setData(array($f[$i]['name']=>$f[$i]['value']));
			 
				$columnNames = $model->getColumnNames();
				$excludeFromValidation = array();
				
				foreach($columnNames as &$c)
				{
					if($c!=$f[$i]['name'])
					{
						$excludeFromValidation[] = $c;
					}
				}
				$model->filter();
				
				$errors = $model->getValidationErrors();
				 
				if(!empty($errors))
				{
					$this->exitWithError($errors);
				} 
				if($i==0)
				{
					$queryString.= '(';
				} 
				else 
				{
					$queryString.= $this->getOperators($f[$i]['operator']);
				}
					
				$queryString.= ' '.$f[$i]['name'].' '.$this->getComparison($f[$i]['comparison']).' \''.$model->getData($f[$i]['name']).'\'';
				
				if($i==(sizeof($f)-1))
				{
					$queryString.=' ) ';
				} 
			}
		
			$queryString.= ')';
		
			$firstIteration = false;
		};
		return $queryString;
	} 
	  
	public function getOperators($key=null)
	{
		
		if($key!=null)
		{	
			$key = strtolower($key);
			if(isset($this->operators[$key]))
			{
				return $this->operators[$key];
			}
			return false;
		}
		return $this->operators;
	}

	public function getComparison($key=null)
	{ 
		if($key!=null)
		{	
			$key = strtolower($key);
			if(isset($this->comparison[$key]))
			{
				return $this->comparison[$key];
			}
			return false;
		}
		return $this->comparison;
	}  
	
	public function actionLogout()
	{  
		 $user = new Core_Auth_User(); 
		 $user->destroy();    
	}
	
	public function actionLogin()
	{
		$this->preventTemplateRender();
		$user = new Model_UserModel();
		
		$isVarsSet = true;
		if(!isset($_REQUEST['username']))
		{
			$user->setValidationError('username', 'Username not set');
			$isVarsSet = false;
		}
		
		if(!isset($_REQUEST['password']))
		{
			$user->setValidationError('password', 'Password not set');
			$isVarsSet = false;
		}
		
		if(!$isVarsSet)
		{
			echo json_encode(array('status'=>'error','errors'=>$user->getValidationErrors()));
			return;
		}
		
		$user->setUserName($_REQUEST['username']);
		$user->setPasswordBeforeSalt($_REQUEST['password']);
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
				if(Application::getSessionType() == Application::SESSION_TYPE_DB)
				{
					$storage = new Model_SessionStorageModel();
					$storage->setUserId($user->getUserId());
					$storage->setHash(session_id());
					$storage->insert();	
				} 
				exit(session_id());
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
		$user = new Model_UserModel();
		$isVarsSet = true;
		if(!isset($_REQUEST['user_nameReg']))
		{
			$user->setValidationError('username', 'Username not set');
			$isVarsSet = false;
		}
		
		
		if(!isset($_REQUEST['passwordReg']))
		{
			$user->setValidationError('password', 'Password not set');
			$isVarsSet = false;
		}
		
		if(!isset($_REQUEST['first_name']))
		{
			$user->setValidationError('first_name', 'Firstname not set');
			$isVarsSet = false;
		}
		
		if(!isset($_REQUEST['last_name']))
		{
			$user->setValidationError('password', 'Last name not set');
			$isVarsSet = false;
		}
		
		if(!isset($_REQUEST['email']))
		{
			$user->setValidationError('email', 'Email not set');
			$isVarsSet = false;
		}
		
		if(!$isVarsSet)
		{
			echo json_encode(array('status'=>'error','errors'=>$user->getValidationErrors()));
			return false;
		}
		
		$user->setUserName($_REQUEST['user_nameReg']);
		$user->setPasswordBeforeSalt($_REQUEST['passwordReg']);
		$user->setFirstName($_REQUEST['first_name']);
		$user->setLastName($_REQUEST['last_name']);
		$user->setEmail($_REQUEST['email']);
		$user->validateFields(array('user_name','password','first_name','last_name','email'));
		$thirdPartyLoginId = null;
		if(isset($_REQUEST['thirdPartyLoginId']))
		{
			$thirdPartyLoginId = (int)$_REQUEST['thirdPartyLoginId'];
		}
		$user->setThirdPartyLoginId($thirdPartyLoginId);
		
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
