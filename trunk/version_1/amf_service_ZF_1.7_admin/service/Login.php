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

class Login
{
	public function __construct()
	{ 
		$this->test = new CustomError(); 
		$this->auth=Zend_Auth::getInstance();  
	}

	public function Login($username,$pass)
    {       
	    $this->conn = new StoredConnections(false);
	   
    	$query ="call selectSalt('".$username."')" ;
        $salt= $this->conn->result( $query );
 
        if(!is_array( $salt))
	    {
			$this->test->type="error";
	  	    $this->test->info="nouser"; 
	   	  	Zend_Session::destroy(true);
	  	    return  $this->test;
	    } 
          
	    $pasWithSalt=$pass.$salt[0][0] ;
	    $hash=sha1($pasWithSalt);
  
      	$query ="call   selectLoginUser('".$username."','".$hash."')" ;
        $loginData= $this->conn->result( $query );
           
        if(!is_array($loginData))
	    {
			$this->test->type="error";
	  	    $this->test->info="nouser"; 
	  		Zend_Session::destroy(true);
	  	    return  $this->test;
	    } 
	      
       	if($loginData[0][1]==0)
       	{
       	    $this->test->type="error";
	  	    $this->test->info="nouser";  
	  		Zend_Session::destroy(true);
	  	    return  $this->test;
       	}
 		$databaseInfo = new Zend_Session_Namespace('DatabaseInfo');
    	$databaseInfo->unsetAll();  
    	$databaseInfo->setExpirationSeconds(2666) ;
    	 	     
    	$databaseInfo->remoteIp=$_SERVER['REMOTE_ADDR'];
	   	$userData=array();
	   	$userData[0]=$loginData[0][0]; 
	   	$userData[1]=$loginData[0][1];
      
	   	$databaseInfo->userData=$userData;  
	     
    	$databaseInfo->lock();
        $this->test->type="ok"; 
		return $this->test;      
    } 
}

 