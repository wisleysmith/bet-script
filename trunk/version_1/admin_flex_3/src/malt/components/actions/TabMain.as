/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{ 
	import malt.core.controls.Actions;
	import flash.events.Event;
	import mx.collections.ArrayCollection;
		
	public class TabMain extends Actions
	{ 
	    public function constructComponent():void
 		{ 
 		      component.mainTab.addEventListener("change",mainItemClick)
  	  	}
  	  	
  	  	public function mainItemClick(data:Event):void
  	  	{
  	  	    switch (data.currentTarget.selectedIndex )
  	  	    {
  	  	    	case 0:
  	  	    	manage();
  	  	    	break;
  	  	    	case 1:
  	  	    	createBet();
  	  	    	break;
  	  	    	case 2:
  	  	    	 bets();
  	  	    	break;
  	  	    	case 3:
  	  	    	arhive();
  	  	    	break;
  	  	    		case 3:
  	  	    	arhive();
  	  	    	break;
  	  	    		case 6:
  	  	    	database();
  	  	      
  	  	    }
  	  	}
  	  	
  	  	public function manage():void
  	  	{
  	  		component.Manage.sports.call.callSelectSport()
  	  	}
  	  	
		public function createBet():void
		{ 
			if(component.Bets.accordMain!=null)
			{
				if(component.Bets.accordMain.selectedIndex==0)
				{
					if(component.Bets.call.status)
					{
						component.Bets.call.callSportData();
						component.Bets.groupsCB.dataProvider=null;
			    		component.Bets.eventDG.dataProvider==null;
						component.Bets.teamsTableData.dataProvider=null; 
			            component.Bets.eventDG.dataProvider=null;
			            component.Bets.myrep.dataProvider=null
			            component.Bets.call._teamHolder.removeAll();
					}
				}  
				else if(component.Bets.accordMain.selectedIndex==1)
				{
					if(component.Bets.call.status2)
					{
						component.Bets.eventDGE.dataProvider=null;
						component.Bets.eventTeamDataGrid.dataProvider=null;
						component.Bets.call.callSportData();
						component.Bets.sportCBBet.dataProvider=null;
						component.Bets.call._betRepeater.removeAll();
						component.Bets.call._betRepeaterReset.removeAll();
						component.Bets.eventCBBet.dataProvider=null;
			  			component.Bets.groupsCBBet.dataProvider=null;
			  			component.Bets.eventCB.dataProvider=null;
			  			component.Bets.betNameTI.text= "";
	  	 	  			component.Bets.oneTeamCheckB.selected=false;
	 	  	  		    component.Bets.oneTeamSelect.enabled=false;
	 	  	  		    component.Bets.myrepBet.dataProvider=null;
	 	  	  			component.Bets.betActiveLabel.text="";
	  	           		component.Bets.betEndLabel.text = "" ;
	  	           		component.Bets.oneTeamSelect.text = "" ;
	 	  	  			 
					}
				}  
			 
				
				
			} 
			 
  	  	}
  	  	
		public function bets():void
		{ 
			 if(component.SportsBets!=null)
			 {
			 	  if(component.SportsBets.call.status)
				  {
				 	 component.SportsBets.call.initSportbetService();	 
		 	  	  }
	 	  	  }
  	  	}
  	  	
  	  	public function arhive():void
  	  	{
  	  	   component.ArhiveBets.mainBetPanel.title=""
  	  		component.ArhiveBets.rep.dataProvider=new ArrayCollection();
  	  	}
  	  	
		 public function database():void
		 {
		 	
		 }
  	  	
		 
  	  	   
	}	
	
	
}