<?php
class View_Frontend_UserBank extends Core_View_Layout_Template
{  
	private $userBankTable;
	private $userId;
	 
	private function setUserBankTable()
	{
		$user = new Core_Auth_User();
		$role = $user->getRole();
		$userId = $this->getUserId();
		
		if($role=='admin'||$role=='superadmin')
		{ 
			$bank = new Extension_View_Yui35_DataTableEdit(); 
			$bank->isAddButtonEnabled(false);
			$bank->isEditEnabled(false);
		}
		else 
		{
			$bank = new Extension_View_Yui35_DataTablePF();
			if($userId===null)
			{
				return;
			} 
		}
 		
		$table = $bank->getTable();
		
		$model = new Model_TransactionModel(); 
		$model->setUserId($userId);
		
		 
		if($userId == null)
		{
			$model->addQuery('select',array('table'=>$model->getTableName()));
		}
		else 
		{
			$model->getTransactionsByUser();
		}
		
		$model->addQuery('order',array('order'=>implode($model->getPrimaryKeys(),",").' DESC'));
		$model->addQuery('limit',array('limit'=>20)); 
		
		$bank->setModel($model);
		
		$table->addColumn(array('key'=>'transaction_id','label'=> 'ID'));
		$table->addColumn(array('key'=>'money','label'=> 'Money')); 
		$table->addColumn(array('key'=>'date_created','label'=> 'Date')); 
		  
		  
		$typeModel = new Model_TransactionTypeModel();
		$typeModel->addQuery('select',array('table'=>$typeModel->getTableName()));
		$typeCollection = new Core_Model_Adapter_ModelCollection();
		$typeCollectionData = $typeCollection->getModelCollection($typeModel);
		$table->addColumn('{key:"transaction_type_id_FK",label:"Type Of Transaction",allowHTML:true,formatter:'.$table->getFormatter("labelFromModelCollection",array('values'=>$typeCollectionData,'value'=>'transaction_type_id','label'=>'transaction_name','attributes'=>array('name'=>'model['.$model->getModelClassName().'][transaction_type_id_FK]'))).'}',false,'transaction_type_id_FK');
		
		$url = Application::getRouter()->getUrl(array('controller'=>'servicehtml','action'=>'view'));   
		$table->addColumn(array('key'=>'transaction_id','label'=> 'ID'));
		$table->addColumn(array('key'=>'money','label'=> 'Money')); 
		$table->addColumn(array('key'=>'date_created','label'=> 'Date')); 
		$table->addColumn('{key:"transaction_type_id_FK",label: "Details",allowHTML:true,formatter:function (o){ if(o.value==2||o.value==3){return "<a class=\'systemSubServiceLinkBank\' servicehtml=\''.$url.'&view=View_Frontend_UserBetSlip&bet_slip_id="+o.data.transaction_type_idendifier+"\' href=\'javascript:void(0)\' >View</a>";}else{return "-"}}}',false,'bet_slip_id_view');
		  
		 
		
		$status = new Extension_View_Html_Form_Elements_Select();
		$status->setModel($typeCollection->toArray());
		$status->setOptionLabelKey('transaction_name');
		$status->setOptionValueKey('transaction_type_id');
		$status->setAttributes(array('name'=>'transaction_type_id_FK','type'=>'text')); 
		$status->setPrependHtml('Status: ');   
		$bank->addFilter($status);
		
		$filterCalendar = new Extension_View_Html_Form_Elements_Calendar();
		$filterCalendar->setPrependHtml('<br />Date from:');
		$filterCalendar->setAttribute('name','date_created');
		$bank->addFilter($filterCalendar,array('group'=>'added','operator'=>'and','comparison'=>'>')); 
		
		$filterCalendar = new Extension_View_Html_Form_Elements_Calendar();
		$filterCalendar->setPrependHtml('Date to:'); 
		$filterCalendar->setAttribute('name','date_created');
		$bank->addFilter($filterCalendar,array('group'=>'added','operator'=>'and','comparison'=>'<')); 
		
		
		$filterMoney = new Extension_View_Html_Form_Elements_Input();
		$filterMoney->setPrependHtml('<br />Money from:');
		$filterMoney->setAttribute('name','money');
		$bank->addFilter($filterMoney,array('group'=>'money','operator'=>'and','comparison'=>'>')); 
		
		$filterMoney = new Extension_View_Html_Form_Elements_Input();
		$filterMoney->setPrependHtml('Money to:');
		$filterMoney->setAppendHtml('</br>');
		$filterMoney->setAttribute('name','money');
		$bank->addFilter($filterMoney,array('group'=>'money','operator'=>'and','comparison'=>'<')); 
		 
		
		if($role=='admin'||$role=='superadmin')
		{
			$userIdFiterId = new Extension_View_Html_Form_Elements_Input(); 
			$userIdFiterId->setAttributes(array('type'=>'hidden','name'=>'user_id_FK','value'=>$userId,'class'=>'filterInput')); 
			$bank->addFilter($userIdFiterId);
		}
		else 
		{
			$method = new Extension_View_Html_Form_Elements_Input(); 
			$method->setAttributes(array('type'=>'hidden','name'=>'method','value'=>'getTransactionsByUser','class'=>'filterInput')); 
			$bank->addAdditionalFilterElement($method);
		}
		
		$this->userBankTable = $bank; 
   	} 
	  
	public function getUserBankTable()
	{ 
		if(!isset($this->userBankTable))
		{
			$this->setUserBankTable();  
		}
		//$this->setPanelOptions($this->userBankTableWithPanel->getPanel());
		return $this->userBankTable; 
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
			if($id!==null)
			{
				$this->userId = $id;
			}
		}
		else 
		{
			$this->userId = $user->getUserId();
		}
	
		return $this->userId;
	} 
}