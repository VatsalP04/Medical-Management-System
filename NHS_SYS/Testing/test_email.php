<!DOCTYPE html>
<html>
<body>
<?php
    include("connection.php");

    $secret_code = bin2hex(random_bytes(3));
    $email = "vatpat@gmail.com";
    $que= "UPDATE users SET secret = 123456 WHERE user_name = 'vatpat@gmail.com'";

    echo"$que";
    $result= mysqli_query($con,$que);
    if ($result){
        echo"Email sent ";
    }
    else{
        echo "ns...ent";
    }

?>
</body>
</html>
