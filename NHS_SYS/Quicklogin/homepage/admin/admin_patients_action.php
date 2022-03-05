
<?php  
//action.php
$connect = mysqli_connect('localhost', 'root', 'root', 'login_sample_db');

$input = filter_input_array(INPUT_POST);

$Patient_name = mysqli_real_escape_string($connect, $input["Patient_name"]);
$Postcode = mysqli_real_escape_string($connect, $input["Postcode"]);
$Reason = mysqli_real_escape_string($connect, $input["Reason"]);
$Notes = mysqli_real_escape_string($connect, $input["Notes"]);
$Last_Appointment = mysqli_real_escape_string($connect, $input["Last_Appointment"]);
$Assign = mysqli_real_escape_string($connect, $input["Assign"]);




if($input["action"] === 'edit')
{
    $query = "
    UPDATE patients 
    SET Patient_name = '".$Patient_name."', 
    Postcode = '".$Postcode."', 
    Reason = '".$Reason."',
    Notes = '".$Notes."',
    Last_Appointment ='".$Last_Appointment."',
    Assign= '".$Assign."'

    WHERE id = '".$input["id"]."'
    ";

    mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM patients 
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($connect, $query);

 window.location.reload();
}

echo json_encode($input);

?>
