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
 * manage groups
 * Every sport have multiple groups
 * like soccer can have, Premier leaguea and Seria A etc.
 */
class Groups
{
	public function __construct()
	{
		$this->conn = new StoredConnections();
		$this->test = new CustomError(); 
	}

	public function selectGroupsRows( $id)
    {   
    	if($this->conn->checkAdmin())
    	{
		 	$int = new Zend_Validate_Int();
         
         	if(!$int->isValid($id))
       	 	{
       	  	 	return $this->test;
       	 	} 
       	 
        	$query = "CALL selectGroups( '".$id."');CALL selectSports( )";    
        	$this->test->type="null";
        	$this->test->message=$this->conn->multiresultbackArray( $query); 
         	return   $this->test; 
    	}
    	else 
    	{
    			$this->test->type="error";
    			$this->test->info="nologin";
    			return $this->test;
    	}
    }

 
    public function  insertGroupsRows ($text,$id )
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
    	    
        	$query = "CALL insertGroups('".$text."','".$id."');";   
        	$result= $this->conn->insert( $query); 
        
         	$query = "CALL selectGroups( '".$id."');CALL selectSports( )";    
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
    
 
    public function  updateGroupsRows  ($text, $id,$sportId)
    {   
    	if($this->conn->checkAdmin())
    	{
 		 	$int = new Zend_Validate_Int();
        
	        if(!$int->isValid($id))
	        {
	       	    return $this->test;
	        } 
	      
	    	if(!$int->isValid($sportId))
	        {
	       	  	return $this->test;
	        } 
	       
			$validator = new Zend_Validate_StringLength(2,100);
		   	if (!$validator->isValid($text)) 
			{
				 return $this->test;
			} 
		    	  
		    $query = "CALL updateGroups('".$text."','".$id."');";   
	        $result= $this->conn->insert( $query); 
	        
	        $query = "CALL selectGroups( '".$sportId."');CALL selectSports( )";    
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
        
    public function  deleteGroupsRows ( $id,$sportId)
    {   
    	if($this->conn->checkAdmin())
    	{
    	 	$int = new Zend_Validate_Int();
        
	        if(!$int->isValid($id))
	        {
	       	  	return $this->test;
	        } 
	        
	        if(!$int->isValid($sportId))
	        {
	       	  	return $this->test;
	        } 
	      
	        $query = "CALL deleteGroups('".$id."')";
	        $result = $this->conn->insert( $query);  
	         
	        $query = "CALL selectGroups( '".$sportId."');CALL selectSports( )";    
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