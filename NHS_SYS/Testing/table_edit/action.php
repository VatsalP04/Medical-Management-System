<?php  
//action.php
$connect = mysqli_connect('localhost', 'root', 'root', 'login_sample_db');

$input = filter_input_array(INPUT_POST);

$Patient_name = mysqli_real_escape_string($connect, $input["Patient_name"]);
$Postcode = mysqli_real_escape_string($connect, $input["Postcode"]);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE tbl_user 
 SET Patient_name = '".$Patient_name."',
 Postcode = '".$Postcode."'

 WHERE id = '".$input["id"]."'
 ";

 mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM tbl_user 
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($connect, $query);
}

echo json_encode($input);

?>