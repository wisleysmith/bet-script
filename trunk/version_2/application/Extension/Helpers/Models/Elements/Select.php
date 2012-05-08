<?php 

class Extension_Helpers_Models_Elements_Select
{
	
	public static function yesNo()
	{
		return array(
			array('value'=>1,'label'=>'Yes'),
			array('value'=>0,'label'=>'No'),
		);
	}
	
	public static function days()
	{
		$days=array();		
		for ($i=1;$i<32;$i++)
		{
			$days[]=array('label'=>$i,'value'=>$i);
		}
		return $days;
	}
	
	public static function months()
	{
		$months=array();		
		for ($i=1;$i<13;$i++)
		{ 
			$months[]=array('label'=>$i,'value'=>$i);
		}
		return $months;
	}
	
	public static function years()
	{
		$years=array();		
		$years[]=array('label'=>2012,'value'=>2012);
		$years[]=array('label'=>2013,'value'=>2013);
		$years[]=array('label'=>2014,'value'=>2014);
		$years[]=array('label'=>2015,'value'=>2015);
		return $years;
	}
	

	public static function hours()
	{
		$hours=array();		
		for ($i=0;$i<24;$i++)
		{ 
			$value='';
			if($i<10)
			{
				$value ="0".$i;
			}
			else 
			{
				$value = $i;
			}
			$hours[]=array('label'=>$value,'value'=>$value);
		}
		return $hours;
	}
	

	public static function minutes()
	{
		$minutes=array();		
			
		for ($i=0;$i<60;$i++)
		{ 
			$value='';
			if($i<10)
			{
				$value ="0".$i;
			}
			else 
			{
				$value = $i;
			}
			$minutes[]=array('label'=>$value,'value'=>$value);
		}
		return $minutes;
	}
	
}

?>