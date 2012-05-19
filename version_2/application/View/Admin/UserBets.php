<?php
class View_Admin_UserBets extends Core_View_Layout_Template
{  
	private $userBetsTable;
	private $userId;
	
	private function setUserBetsTable()
	{ 
		$user = new Core_Auth_User();
		$role = $user->getRole();
		$userId = $this->getUserId();
		
		if($role=='admin'||$role=='superadmin')
		{ 
			$bets= new Extension_View_Yui35_DataTableEdit();
			$bets->isAddButtonEnabled(false);
			$bets->isEditEnabled(false);
		}
		else 
		{
			
			$bets= new Extension_View_Yui35_DataTablePF();
			if($userId===null)
			{
				return;
			} 
		}
		
		$table = $bets->getTable(); 
		
		$model = new Model_BetSlipModel(); 
		$model->getBetSlipsTransaction();
		if($userId!==null)
		{
			$model->addQuery('where',array('where_condition'=>'bs.user_id_FK='.(int)$userId));
		}
		$model->addQuery('order',array('order'=>implode($model->getPrimaryKeys(),",").' DESC'));
		$model->addQuery('limit',array('limit'=>20));  
		
		$bets->setModel($model);
		$url = Application::getRouter()->getFullUrl(array('controller'=>'servicehtml','action'=>'view'));
		$table->addColumn(array('key'=>'bet_slip_id','label'=> 'ID'));
		$table->addColumn(array('key'=>'date_created','label'=> 'Played'));  
		$table->addColumn('{key:status,label: "Status",allowHTML:true,formatter:function(o){if(o.data.status==2){return "Finished"} else {return "In Play"}}}',false,'transaction_type_id_FK');
		$table->addColumn('{key:"bet_slip_id",label: "Details",allowHTML:true,formatter:"<a class=\'systemSubServiceLinkBets\' servicehtml=\''.$url.'&view=View_Frontend_UserBetSlip&bet_slip_id={value}\' href=\'javascript:void(0)\' >View</a>"}',false,'bet_slip_id_view');
		$table->addColumn(array('key'=>'money','label'=> 'Money'));
		 
		 
		$status = new Extension_View_Html_Form_Elements_Select();
		$status->setModel(array(array('label'=>'Finished','value'=>'2'),array('label'=>'In play','value'=>'0')));
		$status->setOptionLabelKey('label');
		$status->setOptionValueKey('value');
		$status->setAttributes(array('name'=>'status','type'=>'text')); 
		$status->setPrependHtml('Status: ');   
		$bets->addFilter($status);
		
		$filterCalendar = new Extension_View_Html_Form_Elements_Calendar();
		$filterCalendar->setPrependHtml('<br />Date from:');
		$filterCalendar->setAttribute('name','date_created');
		$bets->addFilter($filterCalendar,array('group'=>'added','operator'=>'and','comparison'=>'>')); 
		
		$filterCalendar = new Extension_View_Html_Form_Elements_Calendar();
		$filterCalendar->setPrependHtml('Date to:'); 
		$filterCalendar->setAttribute('name','date_created');
		$bets->addFilter($filterCalendar,array('group'=>'added','operator'=>'and','comparison'=>'<')); 
		
		
		$filterMoney = new Extension_View_Html_Form_Elements_Input();
		$filterMoney->setPrependHtml('<br />Money from:');
		$filterMoney->setAttribute('name','money');
		$bets->addFilter($filterMoney,array('group'=>'money','operator'=>'and','comparison'=>'>')); 
		
		$filterMoney = new Extension_View_Html_Form_Elements_Input();
		$filterMoney->setPrependHtml('Money to:');
		$filterMoney->setAppendHtml('</br>');
		$filterMoney->setAttribute('name','money');
		$bets->addFilter($filterMoney,array('group'=>'money','operator'=>'and','comparison'=>'<')); 
		  
		
		if($role=='admin'||$role=='superadmin')
		{
			$userIdFiterId = new Extension_View_Html_Form_Elements_Input(); 
			$userIdFiterId->setAttributes(array('type'=>'hidden','name'=>'bs.user_id_FK','value'=>$userId,'class'=>'filterInput')); 
			$bets->addFilter($userIdFiterId);
			
			$method = new Extension_View_Html_Form_Elements_Input(); 
			$method->setAttributes(array('type'=>'hidden','name'=>'method','value'=>'getBetSlipsTransaction','class'=>'filterInput')); 
			$bets->addAdditionalFilterElement($method); 
		}
		else 
		{
			$method = new Extension_View_Html_Form_Elements_Input(); 
			$method->setAttributes(array('type'=>'hidden','name'=>'method','value'=>'getBetSlipsTransactionByUser','class'=>'filterInput')); 
			$bets->addAdditionalFilterElement($method);
		} 
		 
		$this->userBetsTable = $bets; 
   	} 
	 
	public function getUserBetsTable()
	{ 
		if(!isset($this->userBetsTable))
		{
			$this->setUserBetsTable();  
		}
		//$this->setPanelOptions($this->userBetsTableWithPanel->getPanel());
		return $this->userBetsTable; 
	} 
	
	public function getUserId()
	{ 
		if(!isset($this->userId))
		{
			$this->setUserId();
		}
		return $this->userId;
	} 
	
	
	public function setUserId($id = null)
	{
		$user = new Core_Auth_User();
		$role = $user->getRole();
		if($role=='admin'||$role=='superadmin')
		{
			$this->userId = $id;
		}
		else 
		{
			$this->userId = $user->getUserId();
		} 
	} 
	 
}