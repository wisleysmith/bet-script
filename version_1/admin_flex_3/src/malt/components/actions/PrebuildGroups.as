/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{
    import malt.components.service.TeamsAction;
    import malt.core.controls.Actions;
    
    import mx.collections.ArrayCollection;
    import mx.rpc.events.ResultEvent; 
 
	public class PrebuildGroups extends Actions
	{
		 private var _prebuldService:TeamsAction;
		
         public function constructComponent():void
         {
         	_prebuldService=new TeamsAction();
            _prebuldService.callPrebuildGroups(loadGroups);
        
         }
         
         public function loadGroups(event:ResultEvent ):void
         { 
     		component.prebuildGroups.dataProvider= new ArrayCollection(event.result as Array);
         }
         
          
         public function addNewTeams(dataId:uint):void
         {
         	_prebuldService.groupsId=model('Global').groupsId;
         	_prebuldService.prebuildId=dataId; 
         	_prebuldService.callAddNewTeams(addNewTeamResult);
         }
         
         public function addNewTeamResult(event:ResultEvent):void
         { 
         	model('Global').teamsTable= new ArrayCollection(event.result as Array);
         }
         
         public function selectTeams(dataId:uint):void
         { 
         	_prebuldService.prebuildId=dataId; 
         	_prebuldService.callSelectPreteamsService(prebuildTeamsResult);
         }
          
         public function prebuildTeamsResult(event:ResultEvent ):void
         {  
     		component.prebuildTeams.dataProvider= new ArrayCollection(event.result as Array);
         }
         
          public function addNewTeamOne(dataId:uint):void
         { 
         	_prebuldService.groupsId=model('Global').groupsId;
         	_prebuldService.prebuildId=dataId; 
         	_prebuldService.callInsertPrebuildTeamsService(addNewTeamResult);
         }
	}
}