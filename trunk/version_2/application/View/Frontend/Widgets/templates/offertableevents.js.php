 
<?php echo $this->getOfferTable()->getId()?>.delegate('click', function (e) 
{ 
	var td = e.target.ancestor('td'); 
	//e.target.ancestor('td').setAttribute('style','background-color:red');
	//e.target.ancestor('td').setStyle('background-color','red');   
	//e.target.ancestor('td').addClass('tableCellSelected');
	var tr = e.target.ancestor('tr'); 
	var cellIndex = td.get('cellIndex'); 
	var selecting = <?php echo $this->getOfferTable()->getId()?>.get('columns');  
	var data = <?php echo $this->getOfferTable()->getId()?>.getRecord(tr.get('id')).toJSON(); 
	var odds = data[selecting[cellIndex].key]; 
	 
	var odds_id_string = selecting[cellIndex].key+'_odd_value_id';  
	data = {odds:odds,endDate:data['end_date'],event_bets_id:data['event_bets_id'],name:data['event_bets_name'],key:selecting[cellIndex].label,odd_value_id:data[odds_id_string],bets_id:data['bets_id']}
	
	Y.Global.fire('offerTableClicked', {
	    data: data
	    }); 

}, 'td span.betOfferElement'); 

 