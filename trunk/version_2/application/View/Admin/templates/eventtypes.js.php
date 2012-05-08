<?php echo $this->getEventTypesTablePanelInstance()->getTable()->getId()?>.delegate('click', 

function (e) 
{ 
	 	var trRow =  e.currentTarget.ancestor('tr');  
		var data = <?php echo $this->getEventTypesTablePanelInstance()->getTable()->getId()?>.getRecord(trRow.get('id')).toJSON();
		var insertValues = {'event_types_id_FK':data['event_types_id']};
  		Y.one('#editingRow').setContent('You are editing: '+data['event_types_name']);
		<?php echo $this->getEventTypesValuesTableWithPanelInstance()->getTable()->getId()?>.datagridedit.set('insertValues',insertValues);
		Y.one('#event_types_id_FK_<?php echo $this->getEventTypesValuesTableWithPanelInstance()->getId()?>' ).setAttribute('value',data['event_types_id']);
		<?php echo $this->getEventTypesValuesTableWithPanelInstance()->getTable()->getId();?>.datagridedit.filter(); 	

}, 'td input.event_type_values');  