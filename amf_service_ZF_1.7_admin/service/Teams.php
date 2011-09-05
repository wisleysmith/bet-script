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
 * manage teams that exist in group
 */

class Teams 
{
	public function __construct()
	{
		$this->conn = new StoredConnections();
		$this->test = new CustomError(); 
	}

	public function selectTeamsRows($id,$idGroups)
    {   
        if($this->conn->checkAdmin())
    	{
    	 	$int = new Zend_Validate_Int();
         
         	if(!$int->isValid($id))
       	 	{
       			return $this->test;
       	 	} 
         	$query = "CALL selectTeams( '".$id."');CALL selectGroups( '".$idGroups."');";
      
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
    
    public function  insertTeamsRows ($text,$id)
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

		 	$query = "call selectCheckForGroup('".$id."')"; 
         	$result= $this->conn->result( $query);    
		
        	if(!is_array($result))
			{ 
				$result->info="grouperror";
				$result->type="error";
				return $result;
			}
            
        	$query = "CALL insertTeam('".$text."','".$id."')";   
        	return $this->conn->result( $query); 
    	}
    	else 
    	{
    			$this->test->type="error";
    			$this->test->info="nologin";
    			return $this->test;
    	}
    }  
    
 
    public function  updateTeamsRows ($text,$groupId,$id)
    {   
    	if($this->conn->checkAdmin())
    	{
    	
		    $validator = new Zend_Validate_StringLength(2,100);
       		$int = new Zend_Validate_Int();
       		
       		if(!$int->isValid($id))
       		{
            	 return $this->test;
       		} 
       		
            if(!$int->isValid($groupId))
       		{
            	 return $this->test;
       		} 
       	       		
		    if (!$validator->isValid($text)) 
			{
			   return $this->test;
		    } 
		    
	    	$query = "call selectCheckForGroup('".$id."')"; 
         	$result= $this->conn->result( $query);    
		
        	if(!is_array($result))
			{ 
				$result->info="grouperror";
				$result->type="error";
				return $result;
			}
    	
    	  	$query = "CALL updateTeams ( '".$text."','".$groupId."','".$id."')";
	     	return $this->conn->result( $query);
    	}
    	else 
    	{
    			$this->test->type="error";
    			$this->test->info="nologin";
    			return $this->test;
    	}
    }  
        
    public function  deleteTeamsRows ($groupId,$id)
    {   
    	if($this->conn->checkAdmin())
    	{
    		$int = new Zend_Validate_Int();
         
         	if(!$int->isValid($id))
       	 	{
       			return $this->test;
       	 	} 
       	 
       	 	if(!$int->isValid($groupId))
       	 	{
            	 return $this->test;
       	 	} 
       		
       	 	$query = "call selectCheckForGroup('".$id."')"; 
         	$result= $this->conn->result( $query);    
		
       		if(!is_array($result))
			{ 
				$result->info="grouperror";
				$result->type="error";
				return $result;
			}
       	 
    	  	$query = "CALL deleteTeams('".$groupId."','".$id."')";
          	return $this->conn->result( $query);   
           
    	}
    	else 
    	{
    			$this->test->type="error";
    			$this->test->info="nologin";
    			return $this->test;
    	}
    }  
    
    public function prebuildGroups()
    {
		$query = "call selectPrebuildGroups()";
        return $this->conn->result( $query);   
    }
    
    public function addNewTeams($idT,$idG)
    { 
    	if($this->conn->checkAdmin())
    	{
    		$int = new Zend_Validate_Int();
         
         	if(!$int->isValid($idT))
       	 	{
       		  	return $this->test;
       		} 
       	 
       	 	if(!$int->isValid($idG))
       	 	{
       		  	return $this->test;
       	 	} 
       	 
    	  	$query = "call insertPrebuildTeams('".$idT."','".$idG."')";
         	return  $this->conn->result( $query);              
    	}
    	else 
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    }
    
    public function selectPreteamsService($idT)
    {  
    	if($this->conn->checkAdmin())
    	{
    		$int = new Zend_Validate_Int();
         
         	if(!$int->isValid($idT))
       	 	{
       			return $this->test;
       	 	} 
    	 	$query = "call selectPreteams('".$idT."')";
         	return  $this->conn->result( $query);     
    	}
    	else 
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    }
    
    public function insertPrebuildTeamsService($idT,$idG)
    {  
    	if($this->conn->checkAdmin())
    	{
			$int = new Zend_Validate_Int();
         
         	if(!$int->isValid($idT))
       	 	{
       			return $this->test;
       	 	} 
       	 
       	 	if(!$int->isValid($idG))
       	 	{
       			return $this->test;
       	 	} 
    	
    		$query = "call insertOnePrebuildTeam('".$idT."','".$idG."')";
         	return  $this->conn->result( $query);      
        }
    	else 
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    }
}

 