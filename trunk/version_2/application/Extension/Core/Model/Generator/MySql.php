<?php
class Extension_Core_Model_Generator_MySql
{ 
	private $tableName = "";
	private $databaseName = "";
	private $className = "";
	private $classContent = "";
	private $tableShemaData = array();
	private $classMetadata = array(); 
	private $constraintType = array();
	private $link; 
	private $tableRelationsShemaData = array();
	private $path;
	private $validators = array();
	private $filters = array();
	 
	public function __construct()
	{  
		$connection = new Core_Model_Adapter_Query();
		$this->connection = $connection; 
		$this->databaseName = $this->connection->getConnection()->getDatabaseName();
	}
	 
	public function run($table,$class,$path,$overwriteModel=false)
	{   
		$this->className.= $class;
		$this->tableName = $table; 
		$this->path=$path;
		 
		$query = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$this->tableName' AND table_schema = '".$this->databaseName."'" ;
	     
		$result = mysql_query($query);
		 
		if(mysql_num_rows($result)==0)
		{
			echo "<span style='color:red'>Table does not exist</span><br/><br/>"; 
			return;
		}
		
		$resultArray = array();
		while ($row = mysql_fetch_assoc($result)) 
		{
			$this->tableShemaData[] = $row;    
		} 
		 
		if (!$result) {
		     throw new Core_Exceptions(mysql_error());
		}
		 
		$queryRelations = "SELECT  kcg.`TABLE_NAME`,kcg.`COLUMN_NAME`,tb.CONSTRAINT_TYPE,kcg.CONSTRAINT_NAME 	,kcg.TABLE_CATALOG ,	kcg.TABLE_SCHEMA ,	kcg.TABLE_NAME ,	kcg.COLUMN_NAME 	,kcg.ORDINAL_POSITION ,	kcg.POSITION_IN_UNIQUE_CONSTRAINT 	,kcg.REFERENCED_TABLE_SCHEMA ,	kcg.REFERENCED_TABLE_NAME 	,kcg.REFERENCED_COLUMN_NAME
							FROM  INFORMATION_SCHEMA.KEY_COLUMN_USAGE  kcg
							left join INFORMATION_SCHEMA.TABLE_CONSTRAINTS as tb on  kcg.CONSTRAINT_NAME = tb.CONSTRAINT_NAME and  tb.`TABLE_NAME`=kcg.`TABLE_NAME` and tb.`TABLE_SCHEMA`=kcg.`TABLE_SCHEMA`
							where kcg.`TABLE_NAME`='".$this->tableName."' and kcg.`TABLE_SCHEMA`='".$this->databaseName."'";
	    
		 
		$resultRelations = mysql_query($queryRelations);
 
		 
		if (!$resultRelations) {
		    throw new Core_Exceptions(mysql_error());
		}
		 
		$rowRelations=array();
		while ($rowRelations = mysql_fetch_assoc($resultRelations)) 
		{
			$this->tableRelationsShemaData[] = $rowRelations;    
		} 
		 
		foreach($this->tableRelationsShemaData as $tRSD)
		{ 
			if($tRSD['CONSTRAINT_TYPE']!="FOREIGN KEY")
			{
				$this->constraintType[$tRSD['CONSTRAINT_TYPE']][$tRSD['CONSTRAINT_NAME']][] = "'".$tRSD['COLUMN_NAME']."'";
			} 
			else 
			{ 	  
				$this->constraintType[$tRSD['CONSTRAINT_TYPE']][$tRSD['CONSTRAINT_NAME']][]="'".$tRSD['REFERENCED_TABLE_NAME']."'=>'".$tRSD['REFERENCED_COLUMN_NAME']."'";
			}
		}  
	 	$applicationPath = Application::getApplicationPath();
	 	$modelBaseFolder = $applicationPath.DIRECTORY_SEPARATOR.$this->path.DIRECTORY_SEPARATOR.'Base';
	 	$modelFolder =  $applicationPath.DIRECTORY_SEPARATOR.$this->path;
	 	if(!is_dir($modelBaseFolder))
	 	{
	 		mkdir($modelBaseFolder,0777); 
	 	}
 		$this->getProperties();
	 	foreach ($this->classMetadata as $c)
		{
			$this->validators[$c["COLUMN_NAME"]] = $this->mysqlColumnValidators($c); 
			$this->filters[$c["COLUMN_NAME"]] = $this->filterColumnValidators($c);
		}
		
	 	
	 	$baseModelClassName = $modelBaseFolder.DIRECTORY_SEPARATOR.$this->className."Base.php"; ;
		$modelClassName = $modelFolder.DIRECTORY_SEPARATOR.$this->className.".php";
  
		$fh = fopen($baseModelClassName, 'w') or die("can't open file"); 
		fwrite($fh, $this->writeBaseModelClass()); 
		fclose($fh);
	   
		if($overwriteModel)
		{ 
			$fh = fopen($modelClassName, 'w') or die("can't open file"); 
			fwrite($fh, $this->writeModelClass()); 
			fclose($fh);
			chmod($baseModelClassName, 0777);
			chmod($modelClassName, 0777);  
		}
	}
	
	public function writeBaseModelClass()
	{ 
		ob_start ();
		require_once 'templates/model_base.php'; 
		$content = ob_get_contents();
		ob_end_clean();
		return $content; 
	}
	
	public function writeModelClass()
	{ 
		ob_start ();
		require_once 'templates/model.php'; 
		$content = ob_get_contents();
		ob_end_clean();
		return $content; 
	}
	
	public function getProperties()
	{
		if(!empty($this->classMetadata))
		{
			return $this->classMetadata;
		}
		foreach($this->tableShemaData as $t)
		{
			$columnMethodName = "";
			$propertiesArrayTemp = explode ('_', $t['COLUMN_NAME']); 
			$i=0;
			foreach ($propertiesArrayTemp as $p)
			{
				if($i == 0)
				{
					$columnMethodName.= $p;
				}
				else 
				{
					$columnMethodName.= ucfirst($p);
				} 
				$i++;
			}  
			$t["PROPERTY_COLUMN_NAME"] = $columnMethodName; 
			$this->classMetadata [] = $t;
		}
		
		return $this->classMetadata;
	}
	
	public function getTablesName()
	{
		$showTablesResult = mysql_query('SHOW TABLES FROM '.$this->databaseName);
 
		$tables = array();
		while ($row = mysql_fetch_assoc($showTablesResult)) 
		{ 
			$tables[] = $row;   
		}  
		$keyString = 'Tables_in_'.$this->databaseName;
		$tablesArray = array();
		foreach ($tables as $key=>$t)
		{
			$tablesArray[] = $t[$keyString]; 
		} 
		return $tablesArray;
	}
	
	public function mysqlColumnValidators($column)
	{ 	
	
		$returnValue ="";
		$type = $column["DATA_TYPE"];
		$maxSize = $column["CHARACTER_MAXIMUM_LENGTH"];
		$isNullable = $column["IS_NULLABLE"] ;
   		
		$validatorString = "";
	 
		if($type=='tinyint'||$type=='smallint'||$type=='mediumint'||$type=='int'||$type=='bigint'||$type=='float'||$type=='double')
		{
		 	$validatorString[] = '\'numeric\'';
		}
		 
		if($type=='varchar'||$type=='char'||$type=='tinytext'||$type=='text'||$type=='mediumtext'||$type=='longtext'||$type=='binary'||$type=='varbinary'||$type=='tinyblob'||$type=='blob'||$type=='mediumblob'||$type=='longblob'||$type=='set')
		{
		 	if($maxSize>0)
		 	{
		 		$validatorString[] = "'size'=>array('min'=>0,'max'=>$maxSize)";
		 	}
		}  
		 
		 if($type=='time')
		 {
		 	$validatorString[] = '\'time\'';
		 }
		 
		 if($type=='year')
		 {
		 	$validatorString[] = '\'year\'';
		 }
		 
		 if($type=='datetime')
		 {
		 	$validatorString[] = '\'datetime\'';
		 }
		 
	 	 if($type=='date')
		 {
		 	$validatorString[] = '\'date\'';
		 }
		 
		 if($type=='timestamp')
		 {
		 	$validatorString[] = '\'timestamp\'';
		 }
		  
		 if($isNullable == 'NO')
		 {
		 	$validatorString[] = '\'required\''; 
		 }  
		 
		return implode(',', $validatorString);
	}
	
	public function filterColumnValidators($column)
	{
		$filterString = array('\'addslashes\'','\'trim\''); 
		return implode(',', $filterString);
	}
}