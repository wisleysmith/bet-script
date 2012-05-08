<?php 	echo "<?php\n\n";  ?>
 
class <?php echo $this->path.'_'.ucfirst($this->className).' extends '.$this->path.'_Base_'.ucfirst($this->className)."Base\n" ?>
{   
	public function __construct()
	{
		parent::__construct(); 
	}  
}