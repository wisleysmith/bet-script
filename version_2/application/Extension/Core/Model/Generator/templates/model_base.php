<?php echo "<?php\n\n";  $properties = $this->getProperties();?>

  
class <?php echo $this->path.'_Base_'.ucfirst($this->className)."Base extends Core_Model_Adapter_Object\n"; ?>
{      
  	private $validators = array
	(<?php 
			$divaderValidators="";
			foreach ($this->validators as $key=>$v)
			{
echo $divaderValidators."\n\t\t'$key' =>array($v)";
				$divaderValidators=",";
			}
?> 
	);
	
	private $filters = array
	(<?php 
			$divaderValidators="";
			foreach ($this->filters as $key=>$v)
			{
echo $divaderValidators."\n\t\t'$key' =>array($v)";
				$divaderValidators =",";
			}
?> 
	);
	
	
	public function getValidators()
	{
		return $this->validators;
	}
	
	public function getFilters()
	{
		return $this->filters;	
	}  
	  
	public function __construct()
	{ 
		$this->setTableName('<?php echo $this->tableName?>');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
<?php $columnsMeta = "";
		$divader=""; 
		foreach ($this->tableRelationsShemaData as $c)
		{ 
			$columnsMeta = "['".$c['CONSTRAINT_NAME']."']"." =  array("; 
			 
			$divaderInner="";
			foreach($c as $keyInner=>$cInner)
			{
				$columnsMeta.=$divaderInner."'$keyInner'=>'".addslashes($cInner)."'";
				$divaderInner=",";
			}
			$columnsMeta.=");";
			echo "\t\t\$this->relations$columnsMeta\n"; 
		}
?>   
	}
	
	
	private function setColumnsData()
	{
<?php $columnsMeta = "";
	$divader=""; 
	foreach ($this->classMetadata as $c)
	{ 
		$columnsMeta = "['".$c['COLUMN_NAME']."']"." =  array("; 
		 
		$divaderInner="";
		foreach($c as $keyInner=>$cInner)
		{
			$columnsMeta.=$divaderInner."'$keyInner'=>'".addslashes($cInner)."'";
			$divaderInner=",";
		}
		$columnsMeta.=");";
		echo "\t\t\$this->columns$columnsMeta\n"; 
		echo "\t\t\$this->data['$c[COLUMN_NAME]'] = null;\n"; 
	}
	?>   
	}  
	
<?php 
foreach ($properties as $g)
{
	$propertyColumnName = $g['PROPERTY_COLUMN_NAME'];
	$columnName = $g['COLUMN_NAME'];
echo "\tpublic function set".ucfirst($propertyColumnName)."($$propertyColumnName)
\t{
\t\t\$this->data['$columnName'] = $".$propertyColumnName."; 
\t}\n\n";
	} 
?>

<?php 
foreach ($properties as $g)
{
	$propertyColumnName = $g['PROPERTY_COLUMN_NAME'];
	$columnName = $g['COLUMN_NAME'];
echo "\tpublic function get".ucfirst($propertyColumnName)."()
\t{
\t\treturn \$this->data['$columnName']; 
\t}\n\n";
	} 
?>

}

?>
