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
 * bookhouse data, currently just is active or not
 */
class Bookhouse
{
	public function __construct()
	{
		$this->conn = new StoredConnections();
		$this->test = new CustomError(); 
		$this->auth=Zend_Auth::getInstance();  
	}

    public function callDatabaseData ()
	{
		if($this->conn->checkAdmin())
    	{
		 	$query = "call selectDatabaseData()";
         	return $this->conn->result( $query );
    	}
    	else 
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
	}
	
	public function updateBookhouseData ($data,$status)
	{
		if($this->conn->checkAdmin())
    	{
			if($status!=1&&$status!=0)
			{
					return $this->test;
			}
			
			$statusId=$this->conn->getStatus();
	     
	    	if( $statusId==3)
	    	{
	    		 $query = "call updateBookhouse('".$data."','".$status."')";
	        	 return $this->conn->result( $query );
	    	}
	    	else 
	    	{
	    		return $this->test;
	    	}
			 
	    }
	    else 
	    {
	    	$this->test->type="error";
	    	$this->test->info="nologin";
	   		return $this->test;
	    }
	}
}

 