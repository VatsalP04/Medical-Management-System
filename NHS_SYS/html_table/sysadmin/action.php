
<?php  
//action.php
$connect = mysqli_connect('localhost', 'root', 'root', 'login_sample_db');

$input = filter_input_array(INPUT_POST);

$Role = mysqli_real_escape_string($connect, $input["Role"]);


if($input["action"] === 'edit')
{
    switch ($Role) {
        case "1":
            $Role = "user";
            break;
        case "2":
            $Role = "admin";
            break;
        
    }

    $query = "
    UPDATE users
    SET Role = '".$Role."' 
   
    WHERE id = '".$input["id"]."'
    ";

    mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM users 
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($connect, $query);

 window.location.reload();
}

echo json_encode($input);

?>
