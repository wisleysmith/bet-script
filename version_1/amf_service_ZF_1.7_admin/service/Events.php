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
 * managing events in admin part
 * Events are sports event like Chelsea vs. Roma
 */
class Events
{
	public function __construct()
	{
		$this->conn = new StoredConnections();
		$this->test = new CustomError(); 
	}

	public function selectEventsRows( $id)
    {   
    	if($this->conn->checkAdmin())
    	{
			$int = new Zend_Validate_Int();
         
         	if(!$int->isValid($id))
       	 	{
       	 		return $this->test;
       	 	} 
    	
    		$query = "CALL selectEvents('".$id."')";
	     	return $this->conn->result( $query);  
    	}
    	else 
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    }

    public function  insertEventsRows ($text, $id , $array)
    {
    	if($this->conn->checkAdmin())
    	{
    		 
    		$validator = new Zend_Validate_StringLength(1,100);
    		$int = new Zend_Validate_Int();
		 
    		if (!$validator->isValid($text))
    		{
    			return $this->test;
    		}
    		     		 
    		$num=sizeof($array);
    			
    		if(!$int->isValid($num))
    		{
    			return $this->test;
    		}
    			
    		if(2>$num )
    		{
    			return $this->test;
    		}	
    		 
    		if(!$int->isValid($id))
    		{
    			return $this->test;
    		}

    		$query = "CALL insertEvent('".$text."','".$id."')";

    		$idEvent =$this->conn->result( $query);

    		if(!is_array($idEvent))
    		{
    			return  $idEvent ;
    		}
    			
    		$validator->setMax(100);
    		$validator->setMin(0);
    		
 	    	$query2 =" ";

	 	    for($i=0;$i<$num;$i++)
	 	    {
	 	    	if (!$validator->isValid($array[$i]))
	 	    	{
	 	    		return $this->test;
	 	    	}
	 	    		
	 	    	if($array[$i]=="")
	 	    	{
	 	    		$type='null';
	 	    	}
	 	    	else
	 	    	{
	 	    		$type="'".$array[$i]."'";
	 	    	}
	
	 	    	$query2 .= "call insertEventType($type,'".$idEvent[0]["number"]."');"; 	    		
	 	    }
	
	 	    if( $query2 !=" ")
	 	    {
	
	 	    	$this->conn->multiinsert($query2);
	 	    }
 	    	
 	    	$query = "CALL selectEvents('".$id."')";

 	    	return  $this->conn->result( $query );
    	}
    	else
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}    		
    }

    public function  insertEventsTypeRows ($text,$id)
    {
    	if($this->conn->checkAdmin())
    	{
    		$validator = new Zend_Validate_StringLength(0,100);
    		$int = new Zend_Validate_Int();
    		 
    		if(!$int->isValid($id))
    		{
    			return $this->test;
    		}
    		 
    		if (!$validator->isValid($text))
    		{
    			return $this->test;
    		}
    		 
    		if($text=="")
    		{
    			$type='null';
    		}
    		else
    		{
    			$type="'".$text."'";
    		}
    		 
    		$query2 = "call insertEventType($type,'".$id."')";
    		$result=$this->conn->insert( $query2 );

    		if($result->info!="null")
    		{
    			return $result;
    		}
    		 
    		$query = "CALL  selectTypeEvents('".$id."')";
    		return  $this->conn->result( $query );
    	}
    	else
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    		
    }

    public function selectEventsTypesRows($id)
    {

    	if($this->conn->checkAdmin())
    	{
    		$int = new Zend_Validate_Int();
    		 
    		if(!$int->isValid($id))
    		{
    			return $this->test;
    		}
    		 
    		$query = "CALL selectTypeEvents('".$id."')";
    		return  $this->conn->result( $query);
    	}
    	else
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    		
    }

    /*
     $arrayParam new data, column,sport,id
     */
    public function  updateEventsRows ($text,$id,$sport)
    {
    	if($this->conn->checkAdmin())
    	{
    		$validator = new Zend_Validate_StringLength(1,100);
    		$int = new Zend_Validate_Int();
    		 
    		if(!$int->isValid($id))
    		{
    			return $this->test;
    		}
    		 
    		if(!$int->isValid($sport))
    		{
    			return $this->test;
    		}
    		 
    		if (!$validator->isValid($text))
    		{
    			return $this->test;
    		}
    		 
    		$query = "call updateEvents('".$text."','".$id."','".$sport."')";
    		return   $this->conn->result( $query);
    	}
    	else
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    }

    public function  updateEventsTypesRows ($text,$id)
    {
    	if($this->conn->checkAdmin())
    	{
    		$validator = new Zend_Validate_StringLength(0,100);
    		$int = new Zend_Validate_Int();
    		 
    		if(!$int->isValid($id))
    		{
    			return $this->test;
    		}
    		 
    		if (!$validator->isValid($text))
    		{
    			return $this->test;
    		}
    		 	 
    		if($text=="")
    		{
    			$type='null';
    		}
    		else
    		{
    			$type="'".$text."'";
    		}

    		$query = "call updateEventType($type,'".$id."')";
    		return $this->conn->result( $query);
    	}
    	else
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    }

    public function  deleteEventsRows ( $id,$sport)
    {
    	if($this->conn->checkAdmin())
    	{
    		$int = new Zend_Validate_Int();
    		 
    		if(!$int->isValid( $id))
    		{
    			return $this->test;
    		}

    		if(!$int->isValid($sport))
    		{
    			return $this->test;
    		}
    		 
    		$query = "CALL deleteEvents('".$id."','".$sport."')";
       
    		return $this->conn->result( $query);
    	}
    	else
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}		
    }

    public function  deleteEventType ( $id)
    {
    	if($this->conn->checkAdmin())
    	{
    		$int = new Zend_Validate_Int();
    		 
    		if(!$int->isValid( $id))
    		{
    			return $this->test;
    		}
    		 
    		$query = "call selectEventCount('".$id."') ";
    		$testSizeNum =$this->conn->result( $query);

    		if($testSizeNum[0]["number"]>3)
    		{
    			return $this->test;
    		}

    		$query = "CALL deleteEventType('".$id."')";
    		return $this->conn->result( $query);
    	}
    	else
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}		
    }
}

