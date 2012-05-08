<?php
class View_Admin_UserBank extends Core_View_Layout_Template
{  
	private $userBankTableWithPanel;
	
	public function __construct()
	{ 
		$this->userBankTableWithPanel = new Extension_View_Yui35_DataTableEdit();
	}  
	
	private function setUserBankTablePanel()
	{
		if(isset($_GET['user_id']))
		{
			$userId = (int)$_GET['user_id'];
		}
		else 
		{
			$userId = null;
		}
		
		$table = $this->userBankTableWithPanel->getTable(); 
		if($userId===null)
		{
			return;
		}
		$model = new Model_TransactionModel(); 
		$model->addQuery('select',array('table'=>$model->getTableName())) ;
		$model->addQuery('order',array('order'=>implode($model->getPrimaryKeys(),",").' DESC'));
		$model->addQuery('limit',array('limit'=>20));  
		$this->userBankTableWithPanel->setModel($model); 
		   
		$table->addColumn(array('key'=>'transaction_id','label'=> 'ID'));
		$table->addColumn(array('key'=>'money','label'=> 'Money')); 
		$table->addColumn(array('key'=>'date_created','label'=> 'Date')); 
		 

		$typeModel = new Model_TransactionTypeModel();
		$typeModel->addQuery('select',array('table'=>$typeModel->getTableName()));
		$typeCollection = new Core_Model_Adapter_ModelCollection();
		$typeCollectionData = $typeCollection->getModelCollection($typeModel);
		$table->addColumn('{key:"transaction_type_id_FK",label:"Type Of Transaction",allowHTML:true,formatter:'.$table->getFormatter("selectFromModel",array('values'=>$typeCollectionData,'value'=>'transaction_type_id_FK','label'=>'transaction_name','attributes'=>array('name'=>'model['.$this->userBankTableWithPanel->getModelName().'][transaction_type_id_FK]'))).'}',false,'transaction_type_id_FK');
		  
		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel($typeCollection->toArray());
	  	$select->setAttribute('name','transaction_type_id_FK');
	  	$select->setOptionLabelKey('transaction_name');
	  	$select->setOptionValueKey('transaction_type_id');  
	  	$select->setPrependHtml('Transaction Type');
		$this->userBankTableWithPanel->addFilter($select); 
		 
   	} 
	 
	public function getUserBankTablePanel()
	{ 
		$this->setUserBankTablePanel();  
		$this->setPanelOptions($this->userBankTableWithPanel->getPanel());
		return $this->userBankTableWithPanel; 
	} 
	
	public function setPanelOptions($panel)
	{
		$panel->addConstructorOption('srcNode' , $panel->getHtmlElementId(true),true); 
        $panel->addConstructorOption('width'        , '450');
        $panel->addConstructorOption('height'        , '450');
        $panel->addConstructorOption('zIndex'       , '1005');
        $panel->addConstructorOption('centered'     , 'true');
        $panel->addConstructorOption('modal'        , 'true');
        $panel->addConstructorOption('visible'      , 'false');
        $panel->addConstructorOption('render'       , 'true');
        $panel->addConstructorOption('plugins'     , '[Y.Plugin.Drag]');  
	}
}