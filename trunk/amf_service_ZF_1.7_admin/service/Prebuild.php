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
 * manage prebuil data. 
 * not yet fully implemented
 * admin can have prebuild data, like sport, leagues
 * now this make no sense because code is Open sourced
 */
class Prebuild
{
	public function __construct()
	{
		$this->conn = new StoredConnections();
	}

	public function selectPrebuildGroupsRows( )
    {   
    	if($this->conn->checkAdmin())
    	{
         	$query = "CALL selectPregroups(0)";
	     	return $this->conn->result( $query);  
    	}
    	else 
    	{
    		$this->test->type="error";
    		$this->test->info="nologin";
    		return $this->test;
    	}
    }
 	
    public function selectPrebuildTeamsRows($param)
    {
    	if($this->conn->checkAdmin())
    	{
    		$query = "CALL selectPreteams( $param)";
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