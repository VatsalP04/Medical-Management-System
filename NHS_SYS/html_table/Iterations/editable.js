$(document).ready(function(){
	$('#patients-table').Tabledit({
		deleteButton: true,
		editButton: true,   		
		columns: {
		  identifier: [0, 'id'],
          editable:[[1, 'Patient_name'], [2, 'Postcode'], [3, 'Reason'], [4, 'Notes'], [5, 'Last_appointment']]                    
		},
		hideIdentifier: true,
		url: 'save_edit.php'		
	});
});