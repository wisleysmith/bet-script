<?php

/**
 * @copyright   Copyright (c) 2012 Oxidian d.o.o (http://www.oxidian.hr)
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

class Controller_Admin extends Core_Controller_Base
{
	public function actionIndex()
	{
		$homePageAdmin = new View_Admin_HomePage();
		    
		$url = Application::getRouter()->getUrl(array('controller'=>'servicehtml','action'=>'view'));
		$menu = new Extension_View_Yui35_Menu();
		 
		$menu->addLink('bookhouse',array('content'=>'Bookhouse'));
		$menu->addLink('groups',array('content'=>'Groups')); 
		$menu->addLink('sports',array('content'=>'Sports'));
		$menu->addLink('settings',array('content'=>'Bookhouse Settings','attributes'=>array('class'=>'systemServiceLink','servicehtml'=>$url.'&view=View_Admin_Bookhouse')));
		$menu->addLink('teams',array('content'=>'Teams','attributes'=>array('class'=>'systemServiceLink','servicehtml'=>$url.'&view=View_Admin_Teams')));
		$menu->addLink('eventTypes',array('content'=>'Event Types','attributes'=>array('class'=>'systemServiceLink','servicehtml'=>$url.'&view=View_Admin_EventTypes')));  
		$menu->addLink('users',array('content'=>'Users'));  
		$menu->addLink('users_edit',array('content'=>'Users Settings','attributes'=>array('class'=>'systemServiceLink','servicehtml'=>$url.'&view=View_Admin_Users')));  
		$menu->addLink('bank',array('content'=>'Bank','attributes'=>array('class'=>'systemServiceLink','servicehtml'=>$url.'&view=View_Admin_Bank')));  
		$menu->addLink('bets',array('content'=>'Bets'));  
		$menu->addLink('create_event',array('content'=>'Create Event','attributes'=>array('class'=>'systemServiceLink','servicehtml'=>$url.'&view=View_Admin_CreateEvent')));  
		
		$menu->addLink('create_bet',array('content'=>'Create Bet','attributes'=>array('class'=>'systemServiceLink','servicehtml'=>$url.'&view=View_Admin_CreateBet')));  
		$menu->addLink('manage_bets',array('content'=>'Manage Bets','attributes'=>array('class'=>'systemServiceLink','servicehtml'=>$url.'&view=View_Admin_ManageBets')));  
		$menu->addLink('manage_eventbets',array('content'=>'Manage Event Bets','attributes'=>array('class'=>'systemServiceLink','servicehtml'=>$url.'&view=View_Admin_ManageEventBets')));  
		
		$menu->addLink('betslips',array('content'=>'Bet Slips','attributes'=>array('class'=>'systemServiceLink','servicehtml'=>$url.'&view=View_Admin_UserBetSlips'))); 
		
		$menu->addChild('menu', 'bookhouse'); 
		$menu->addChild('menu', 'bets');
		$menu->addChild('bets', 'create_event'); 
		$menu->addChild('bets', 'manage_bets'); 
		$menu->addChild('bets', 'manage_eventbets'); 
		 
 
		 
		$menu->addChild('menu', 'users');  
		$menu->addChild('users', 'users_edit');  
		$menu->addChild('users', 'bank');  
		$menu->addChild('users','betslips');
		
		$menu->addChild('bookhouse', 'settings');
		$menu->addChild('bookhouse', 'groups');
		$menu->addChild('groups', 'teams'); 
		$menu->addChild('bookhouse', 'sports');
		$menu->addChild('sports', 'eventTypes'); 
		  
		$this->getTemplate()->setMenu($menu);
		$this->getTemplate()->setContent($homePageAdmin);    
	} 
	
	public function actionBets()
	{
		$betsView = new View_Admin_Bets();
		$this->getTemplate()->setContent($betsView);
	}
}