 <?php
class View_ModelGenerator_Index extends Core_View_Layout_Template
{ 
	public function __construct()
	{ 
		$this->generator = new Extension_Core_Model_Generator_MySql();
		
		$overwriteModel = false;
		if(isset($_POST['overwrite_model']))
		{
			$overwriteModel = true; 
		} 
		
		if(isset($_POST['table_name'])&&isset($_POST['class_model_name'])&&isset($_POST['path']))
		{  
			$this->generator->run($_POST['table_name'],$_POST['class_model_name'],$_POST['path'],$overwriteModel); 
		}  
	}
	
	public function getDatabaseTables()
	{
		return $this->generator->getTablesName();   
	}
}