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

    require_once "service/Bookhouse.php";
    require_once "service/Login.php";
    require_once "service/Groups.php";
    require_once "service/Teams.php";
    require_once "service/Prebuild.php";
    require_once "service/Events.php";
    require_once "service/Bets.php"; 
    require_once "service/Supertoto.php";
    require_once "service/Players.php";
    require_once "service/Sports.php";
 
    // Error Reporting
    error_reporting(E_ALL|E_STRICT);

    // Turn to off when released to production
    ini_set("display_errors","on");
	//set up your zend 1.7 location
	ini_set("include_path", "../../zend/library");

    // Zend Framework Includes
    require_once "Zend/Loader.php";
    require_once 'Zend/Auth.php';
    require_once "Zend/Amf/Server.php";
    require_once "Zend/dbcontrol/StoredConnections.php"; 
    Zend_Loader::registerAutoload();
	Zend_Session::start();
    Zend_Session::regenerateId();
        
    $server = new Zend_Amf_Server();
  
    $server->setClass("Bookhouse");
 	$server->setClass("Bets");
	$server->setClass("Sports");
    $server->setClass("Groups");
	$server->setClass("Teams");
    $server->setClass("Prebuild");
    $server->setClass("Events");
    $server->setClass("Supertoto"); 
    $server->setClass("Players"); 
    $server->setClass("Login");
    // Change this to true when released to production
    $server->setProduction(false);
 
    echo($server->handle());
  
  
  
  
 