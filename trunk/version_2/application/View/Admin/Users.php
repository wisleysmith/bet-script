<?php
class View_Admin_Users extends Core_View_Layout_Template
{  
	private $usersTableWithPanel;
	
	public function __construct()
	{ 
		$this->usersTableWithPanel = new Extension_View_Yui35_DataTableEdit();
	}  
	
	private function setUsersTablePanel()
	{ 
		$table = $this->usersTableWithPanel->getTable(); 
		$model = new Model_UserModel(); 
		$model->addQuery('select',array('table'=>$model->getTableName())) ;
		$model->addQuery('order',array('order'=>implode($model->getPrimaryKeys(),",").' DESC'));
		$model->addQuery('limit',array('limit'=>20));  
		$this->usersTableWithPanel->addRemoveKeyFromData('password');
		$this->usersTableWithPanel->addRemoveKeyFromData('salt');
		$this->usersTableWithPanel->addRemoveKeyFromData('mail_validation');
		$this->usersTableWithPanel->setModel($model);   
		$table->addColumn(array('key'=>'user_id','label'=> 'ID')); 
		$table->addColumn(array('key'=>'first_name','label'=> 'First Name'));  
		$table->addColumn(array('key'=>'last_name','label'=> 'Last Name'));
		$table->addColumn(array('key'=>'user_name','label'=> 'User Name'));   
		$table->addColumn(array('key'=>'password_before_salt','label'=> 'Password'));
		$table->addColumn(array('key'=>'last_login','label'=> 'Last login')); 
		$table->addColumn(array('key'=>'email','label'=> 'Email')); 
		$table->addColumn(array('key'=>'banned','label'=> 'Banned')); 
		$table->addColumn('{key:"email_validated",label:"E-Validated",allowHTML:true,formatter:'.$table->getFormatter("selectYesNo",array('attributes'=>array('name'=>'model['.$this->usersTableWithPanel->getModelName().'][email_validated]'))).'}',false,'email_validated');
		$table->addColumn('{key:"banned",label:"Banned",allowHTML:true,formatter:'.$table->getFormatter("selectYesNo",array('attributes'=>array('name'=>'model['.$this->usersTableWithPanel->getModelName().'][banned]'))).'}',false,'banned');
		$edit = Application::getBaseRelativeUrl().'/images/edit.png';
		$this->usersTableWithPanel->addRemoveKeyFromData('password');
		$this->usersTableWithPanel->setUpdateRule('exclude','last_login'); 
		$this->usersTableWithPanel->setUpdateRule('exclude','yui_datatablepanel_bets_bank');  
		$this->usersTableWithPanel->setInsertRule('exclude','yui_datatablepanel_bets_bank');  
		
		$userStatusModel = new Model_UserStatusModel();
		$userStatusModel->addQuery('select',array('table'=>$userStatusModel->getTableName()));
		$userStatusCollection = new Core_Model_Adapter_ModelCollection();
		$userStatusCollectionData = $userStatusCollection->getModelCollection($userStatusModel);
		
		$urlServiceBankBetFormatter = Application::getRouter()->getUrl(array('controller'=>'servicehtml','action'=>'view')).'&view=View_Admin_UserBankBets&user_id={value}';
	 

		$table->addColumn('{key:"user_status_id_FK",label:"Group",allowHTML:true,formatter:'.$table->getFormatter("selectFromModel",array('values'=>$userStatusCollectionData,'value'=>'user_status_id','label'=>'status_name','attributes'=>array('name'=>'model['.$this->usersTableWithPanel->getModelName().'][user_status_id_FK]'))).'}',false,'user_status');
		$table->addColumn('{key:"user_id",label:"Bets/Bank",allowHTML:true,formatter:\'<a class="yui_datatablepanel_bets_bank systemServiceLink" servicehtml="'.$urlServiceBankBetFormatter.'" href="javascript:void(0);" >Bets/Bank</a>\'}',false,'bets_bank');
		
		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel($userStatusCollection->toArray());
	  	$select->setAttribute('name','user_status_id_FK');
	  	$select->setOptionLabelKey('status_name');
	  	$select->setOptionValueKey('user_status_id');
	  	$select->setPrependHtml('User Status:');   
		$this->usersTableWithPanel->addFilter($select); 
		
		$selectBanned = new Extension_View_Html_Form_Elements_Select();
		$selectBanned->setModel(Extension_Helpers_Models_Elements_Select::yesNo());
	  	$selectBanned->setAttribute('name','banned');
	  	$selectBanned->setOptionLabelKey('label');
	  	$selectBanned->setOptionValueKey('value'); 
	  	$selectBanned->setPrependHtml('User Banned:'); 
		$this->usersTableWithPanel->addFilter($selectBanned); 
	 
		
		$selectMailValidation = new Extension_View_Html_Form_Elements_Select();
		$selectMailValidation->setModel(Extension_Helpers_Models_Elements_Select::yesNo());
	  	$selectMailValidation->setAttribute('mail_validated','banned');
	  	$selectMailValidation->setOptionLabelKey('label');
	  	$selectMailValidation->setOptionValueKey('value');
	  	$selectMailValidation->setPrependHtml('Mail Validated:');   
		$this->usersTableWithPanel->addFilter($selectMailValidation);  
		
		$username = new Extension_View_Html_Form_Elements_Input();  
		$username->setAttributes(array('name'=>'user_name','type'=>'text'));
		$username->setPrependHtml('Username:');   
		
		$firstname = new Extension_View_Html_Form_Elements_Input();
		$firstname->setAttributes(array('name'=>'first_name','type'=>'text'));
		$firstname->setPrependHtml('First Name:');   
		
		$lastname = new Extension_View_Html_Form_Elements_Input(); 
		$lastname->setAttributes(array('name'=>'last_name','type'=>'text')); 
		$lastname->setPrependHtml('Last Name:');   
		
		$this->usersTableWithPanel->addFilter($username);  
		$this->usersTableWithPanel->addFilter($firstname);  
		$this->usersTableWithPanel->addFilter($lastname);  
   	} 
	 
	public function getUsersTablePanel()
	{ 
		$this->setUsersTablePanel();  
		$this->setPanelOptions($this->usersTableWithPanel->getPanel());
		return $this->usersTableWithPanel; 
	} 
	
	public function setPanelOptions($panel)
	{
		$panel->addConstructorOption('srcNode' , $panel->getHtmlElementId(true),true); 
        $panel->addConstructorOption('width'        , '550');
        $panel->addConstructorOption('height'        , '650');
        $panel->addConstructorOption('zIndex'       , '1005');
        $panel->addConstructorOption('centered'     , 'true');
        $panel->addConstructorOption('modal'        , 'true');
        $panel->addConstructorOption('visible'      , 'false');
        $panel->addConstructorOption('render'       , 'true');
        $panel->addConstructorOption('plugins'     , '[Y.Plugin.Drag]');  
	}
}