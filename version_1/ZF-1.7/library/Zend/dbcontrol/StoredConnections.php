<?php
/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
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

/*
 * database connection holder
 * this class me set up in zend framework 1.7 directory
 * you also must set up path to this file in 
 * index.php file  
 */
class StoredConnections
{   
	public  $conn;
	private $loginData;
	public function __construct($checkForSession=true)
	{
		if($checkForSession)
		{
			$databaseInfo = new Zend_Session_Namespace('DatabaseInfo');
			//set up timezone
			date_default_timezone_set("Europe/Zagreb");
 
			if(!isset($databaseInfo->userData))
			{
				Zend_Session::destroy(true);
				exit();
			}
			else 
			{
				$this->loginData=$databaseInfo->userData;
			}
		}  
 		//enterDatabaseData 
 		$this->conn =  mysqli_connect( "???", "???", "???", "???") or die();  		 
	}

	public function mysqli()
	{
		return $this->conn;
	}
	
	public  function getTimezone()
	{	
		$query ="call Timezone()";
		 
		$result = mysqli_query($this->conn , $query ) ;

		$row = mysqli_fetch_array($result);
		return 	 $row[0];
	}
 
	public function checkAdmin()
	{
		$databaseInfo = new Zend_Session_Namespace('DatabaseInfo');
		$this->loginData=$databaseInfo->userData;
	  	if($this->loginData[1]==2||$this->loginData[1]==3)
    	{
    		return true;
    	}
    	else 
    	{
    		return false;
    	}
	}
	/*
	 * thsi is also user ID
	 */
	public function getAdminId()
	{
		$databaseInfo = new Zend_Session_Namespace('DatabaseInfo');
		$this->loginData=$databaseInfo->userData;
		return $this->loginData[0];
	}
	
	public function getStatus()
	{
		return $this->loginData[1];
	}
 
	public function checkUser()
	{ 
		$databaseInfo = new Zend_Session_Namespace('DatabaseInfo');
		$this->loginData=$databaseInfo->userData;
		
		if($this->loginData[1]==1)
    	{ 
    		return true; 
    	}
    	
    	else 
    	{
    		return false;
    	}
	}
	 
	 public function result($query)
	 {
	 	$result = mysqli_query($this->conn , $query ) ;

	 	if(!$result)
		{
		 	return  $this->errorManagmet(mysqli_errno($this->conn)) ;
		}

		 if(mysqli_num_rows($result)==0)
		 {
		 	mysqli_free_result( $result);
		 	mysqli_next_result($this->conn );
		 	return  $this->errorManagmet('null') ;
		 }

		 while ($row = mysqli_fetch_array($result))
		 {
		 	$ArrayOfUsers[] = $row;
		 }
		 mysqli_free_result( $result);
		 	
		 mysqli_next_result($this->conn );
		 return  $ArrayOfUsers ;
	 }
	 
	 public function multiinsert($query)
	 {
	 	$result= mysqli_multi_query($this->conn, $query)  ;

	 	do {
	 		mysqli_store_result($this->conn);
	 		 
	 	} while (mysqli_next_result($this->conn));

	 	if(mysqli_errno($this->conn))
	 	{
	 		return  $this->errorManagmet(mysqli_errno($this->conn)) ;
	 	}
	
	 	return  $this->errorManagmet('null') ;
	  }
	  
	  public function multiresultbackArray($query)
	  { 
	  	$arrFin=array();
	  	/* execute multi query */
	  	if (mysqli_multi_query($this->conn, $query))
	  	{
	  		do {
	  			$arr=array();
	  			/* store first result set */
	  			if ($result = mysqli_store_result($this->conn))
	  			{
	  				while ($row = mysqli_fetch_array($result))
	  				{
	  					$arr[]= $row;
	  				}
	  				mysqli_free_result($result);
	  			}
	  			$arrFin[]=$arr ;
	  		} while (mysqli_next_result($this->conn));
	  	}
	  		
	  	if(mysqli_errno($this->conn))
	  	{
	  		return  $this->errorManagmet(mysqli_errno($this->conn)) ;
		}
			 	
		return  $arrFin ;
	  }
	 
	 public function insert($query)
	 {
	 	$result = mysqli_query($this->conn , $query ) ;

	 	if( $result)
	 	{
	 		return  $this->errorManagmet ('null');
	 	}
	 	if(!$result)
		{
		 	return  $this->errorManagmet(mysqli_errno($this->conn)) ;
		}
	}
	
	public function errorManagmet($param)
	{
	    $test = new CustomError();
	 	if($param==1062)
	 	{
	 	  $test->info="duplicate";
	 	  $test->message="Duplicated data entered, please add uniqe data";
	  	}
	  	else if($param=='null')
	  	{ 
	  		$test->type="null";
	  	    $test->info="null";
	  	} 
	  	else if($param==1451)
	  	{ 
	  		$test->info="constrain";
	  		$test->message="You cant delete events that have bets";
	  	}
	    else if($param==1452)
	  	{ 
	  		$test->info="outdated";
	  		$test->message="Data is out of date";
	  	}
		return   $test;
	}
}

class CustomError
{
	var $type="error";
	var $info="error";
	var $message="Problems with data";
}

?>