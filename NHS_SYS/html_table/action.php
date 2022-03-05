
<?php  
//creates a connection to the database.
$connect = mysqli_connect('localhost', 'root', 'root', 'login_sample_db');

$input = filter_input_array(INPUT_POST);

//The variables are holding the same value but in a format that can be updated to the table through SQL
$Patient_name = mysqli_real_escape_string($connect, $input["Patient_name"]);
$Postcode = mysqli_real_escape_string($connect, $input["Postcode"]);
$Reason = mysqli_real_escape_string($connect, $input["Reason"]);
$Notes = mysqli_real_escape_string($connect, $input["Notes"]);
$Last_appointment = mysqli_real_escape_string($connect, $input["Last_appointment"]);



//If edit is selected then the query written below
// will update the database. 
if($input["action"] === 'edit')
{
    $query = "
    UPDATE patients 
    SET Patient_name = '".$Patient_name."', 
    Postcode = '".$Postcode."', 
    Reason = '".$Reason."',
    Notes = '".$Notes."',
    Last_appointment ='".$Last_appointment."'

    WHERE id = '".$input["id"]."'
    ";

    mysqli_query($connect, $query);

}

//If the action delete is selected then the id will 
//be used to find the row to be deleted on the databsae. 
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
