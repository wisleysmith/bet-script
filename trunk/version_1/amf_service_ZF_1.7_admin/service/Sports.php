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
 * manage sport, soccer, basketball etc.
 */
class Sports
{
	public function __construct()
	{  
		$this->conn = new StoredConnections(); 
		$this->test = new CustomError();  
	}

	public function selectSportRows( )
    {  
       
    	if($this->conn->checkAdmin())
	    {
    	 	$query = "CALL selectSports( )";
	     	return $this->conn->result( $query); 
	    }
    	else 
    	{   
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	} 
    }

    public function  insertSportRows ($text,$id)
    {       	 
    	if($this->conn->checkAdmin())
    	{
       		$validator = new Zend_Validate_StringLength(2,100);
       		$int = new Zend_Validate_Int();
       		
       		if(!$int->isValid($id))
       		{
       			return $this->test;
       		} 
       		
		    if (!$validator->isValid($text)) 
			{
				return $this->test;
		    } 
    	
    	 	$query = "CALL insertSport('".$text."','".$id."')";
         	$result= $this->conn->insert( $query); 
         
         	$query = "CALL selectSports( )";    
         	$result->message=$this->conn->multiresultbackArray( $query); 
         	return  $result; 
    	}
    	else 
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    }  
    
    /*
     $arrayParam new data, column,bookhouse,id
    */
    public function  updateSportRows ($text, $id)
    {    
    	if($this->conn->checkAdmin())
    	{
        	$int = new Zend_Validate_Int();
        
	        if(!$int->isValid($id))
	        {
	       		return $this->test;
	        } 
       
	    	$validator = new Zend_Validate_StringLength(2,100);
	   		if (!$validator->isValid($text)) 
			{
				return $this->test;
			} 
	    	
	        $query = "CALL updateSport ('".$text."','".$id."')";
	       	$result= $this->conn->insert( $query); 
         
           	$query = "CALL selectSports( )";    
           	$result->message=$this->conn->multiresultbackArray( $query); 
           	return  $result;
        }
    	else 
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    }   
        
    /*
     $arrayParam  _idSportName
    */
    public function  deleteSportRows ( $id)
    {  
    	if($this->conn->checkAdmin())
    	{
    	 	$int = new Zend_Validate_Int(); 
        	if(!$int->isValid($id))
        	{
       			return $this->test;
        	} 
    		$query = "CALL deleteSports ('".$id."')";
        	$result= $this->conn->insert( $query); 
         
        	$query = "CALL selectSports( )";    
        	$result->message=$this->conn->multiresultbackArray( $query); 
        	return  $result;
        }
    	else 
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    }  
}