<?php
include_once("inc/functions.php");
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {	
	$updateField='';
	if(isset($input['Patient_name'])) {
		$updateField.= "Patient_name='".$input['Patient_name']."'";
	} else if(isset($input['Postcode'])) {
		$updateField.= "Postcode='".$input['Postcode']."'";
	} else if(isset($input['Reason'])) {
		$updateField.= "Reason='".$input['Reason']."'";
	} else if(isset($input['Notes'])) {
		$updateField.= "Notes='".$input['Notes']."'";
    }else if(isset($input['Last_appointment'])) {
        $updateField.= "Last_appointment='".$input['Last_appointment']."'";
	}
	if($updateField && $input['id']) {
		$sqlQuery = "UPDATE patients SET $updateField WHERE id='" . $input['id'] . "'";	
		mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));		
	}
}
?>