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
 * not implemented yet
 */
class Supertoto
{
	public function __construct()
	{
		$this->conn = new StoredConnections();
	}
	
	public function insertSupertotoService($param,$paramType)
	{ 
		$query = "call insertSuperttoto('".$param[0][0]."','".$param[0][1]."','".$param[0][2]."','".$param[0][3]."','".$param[0][4]."')";
		$idEvent =$this->conn->result( $query );
  
		$array= $paramType;
		$num=sizeof($array); 
  
		$query2 =" ";
		
		for($i=0;$i<$num;$i++)
		{ 
			 $query2 .=   "call insertSupertotoTeams('".$array[$i]."','".$idEvent[0]["number"]."');";	 
		}	 
	   	$this->conn->mysqli()->multi_query($query2);
	  	return "ok";
    }
    
    public function selectSupertoto($param)
    {
          $query = "CALL selectSupertoto('".$param."')";
		  return $this->conn->result( $query );
    }
    
    public function selectSupertotoTeams($param)
    {
    	$query = "call selectSupertotoTeams('".$param."')";
		return $this->conn->result( $query );
    }
    
    public function deleteSupertoto($param)
    {
    	 $query = "call deleteSupertoto('".$param."')";
		 return $this->conn->result( $query );
    }
    
    public function updateSupertotoService($array)
    {
    	 $query = "call updateSupertoto ('".$array[0][0]."','".$array[0][1]."','".$array[0][2]."')";
		 return $this->conn->result( $query );
    }
    
    public function deleteSupertotoTeamService($param)
    {
    	$query = "call deleteSupertotoTeam('".$param."')";
		return $this->conn->result( $query );
    }
}

 