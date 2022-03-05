<?php
require 'patient_homes.php';
$path = new minpath;
$path->setId($_REQUEST['id']); // This will use the function to set id, as what was sent via ajax. 
$path->setLat($_REQUEST['lat']);
$path->setLng($_REQUEST['lng']);

$Status = $path->updatePatientDetailsWithLatLng();
if($Status == true) // Validates if the patient details have been updated to the DB.
{
    echo "Updated";
}else
{
    echo "Failed";
}
?>


