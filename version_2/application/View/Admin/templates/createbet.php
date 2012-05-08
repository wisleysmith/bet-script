<div class="createEvent" > 
	<div id="leftContainer" >
	<div class="createEventWidgetBoxSportsAndGroups">
	<div class="createEventWidgets"><p>Sport:</p>
	<?php 
	echo $this->getSportSelectHtml();
	?>
	</div>
	<div class="createEventWidgets">
	<p>Group:</p>
	
	<div id="groupContent" >
	 </div>
	 <p id="errorGroup" style="display:none" class="error" ></p></div>
	</div>
	
	<div class="createEventWidgetBoxSportsAndGroups">
	<div class="createEventWidgets"><p>Event Types:</p>
	 <div id="eventsTypesContent" >
	 </div>
	 <p id="errorTypesContent" style="display:none" class="error" ></p>
	</div>
	<div class="createEventWidgets">
	<p>Events:</p>
	
	<div id="eventsContent" >
	 </div>
	 <p id="errorEventsContent" style="display:none" class="error" ></p> 
	 </div>
	</div>
	
	 <div class="createEventWidgets">
		 <div>
		 	<div>Event Starts:<br /><span id="eventStart"></span></div>
		 	<div>Event Ends:<br /><span id="eventEnds"></span></div>
		 </div>
	 </div>
	  <div class="createEventWidgets">
		<div>
			Name Of Bet:<input type="text" id="betName" name="betName" />
			<span id="errorBetName" style="display:none" class="error" ></span>
		</div>
		 <input type="button" id="saveBet"  value="Save" /> 
		</div>
		
		<div style="clear:both" id="eventValues" >
		 </div> 
		
	 </div> 
	<div id="rightContainer" >
		<div id='teamsContent'>
		
		</div>
	</div>
 </div>