
<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>

</head>
<body>

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: #247d84;
		border: none;
	}

	#box{

		background-color: #5ac4cb ;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

    a {
        text-align: center
    }

	</style> 


<?php
session_start();
include("connection.php");



$email= $_GET['email']; // This will be fetched from the url link 
$secret_code= $_GET['secret_code'];// This will be fetched from the url link 

if (isset($email) && isset($secret_code)) // only if set can we check if they are the same as db. 
{
    $query = "SELECT * FROM users WHERE user_name = '$email' AND secret_code = '$secret_code'"; // make a query which will check if there is an email on table the same as input email.
    
    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result) == 1){ ?> 

    <div id="box">
        <form method = "post"> <!--Very important method, as it stores all input-->
            <div style= "font-size: 20px; color: whz$ite;text-align:center">Reset Password</div><br>

            <div style= "font-size: 15px; color: White;">New Password:</div><br>
            <input id ="text" type="text" name= "new-password"><br><br> 

            <div style= "font-size: 15px; color: White;">Confirm Password:</div><br>
            <input id ="text" type="text" name= "confirm-password"><br><br> 
        

            <div style= "text-align:center">
            <input id= "button"type="submit" name="change-password" value="Change">  
            </div>
        </form>
    </div>

    <!--<div class="center">
      <h1>Reset Password</h1>
      <form method="post">
        <div class="txt_field">
          <input type="password" name = "new-password" required>
          <span></span>
          <label>New Password:</label>
        </div>
        <div class="txt_field">
          <input type="password" name="confirm-password" required>
          <span></span>
          <label>Confirm Password:</label>
        </div>
        <input type="submit" name="change-password" value="Update Password">
        <div class="empty"></div>
      </form>
    </div>-->

    <?php } 

    else
    {
        echo"invalid link";
    }

}
else{
    echo"bye";
} 


if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $confirm_password = $_POST['confirm-password']; 
        $password = $_POST['new-password'];

        $sql = "SELECT count(*) FROM users WHERE user_name = '$email'"; // make a query which will check if there is an email on table the same as input email.

        //count(*)
        $result = mysqli_query($con,$sql);

        if($result)//if valid user
        {
            if(!empty($confirm_password) && !empty($password)) // presence check
            {  
                if($password == $confirm_password)//if both inputs are same
                {
                    if(strlen($password)>6) //password length greater than 6 characters
                        {
                           if (preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password) && preg_match("/[^£$*@:\#~?><>;@]/", $password))
                           {
                                
                                // Here I have added the validation such that the password must include atleast one letter and at least one number and at least one special character. 

                                $stmt= "UPDATE users SET password = '$password' WHERE user_name = '$email'"; /// also update secret code to null
                            
                                $res= mysqli_query($con,$stmt);

                                echo"$stmt";
                                if ($res){
                                    header("Location: login.php");
                                    die;
                                }
                                else
                                {
                                    echo"not successful";
                                }
                           }
                            else
                            {
                                echo "Password must contain atleast one number,letter and at least one special character from the set: ^£$*@:\#~?><>;@ ";
                            }
                        }
                        else
                        {
                            echo "Password must be greater than 6 characters long ";
                        }
                        
                }
                else
                {
                    echo"Please enter the same password in both boxes.";
                }
            }
            else
            { 
                echo "Please enter some valid information!";
            }
        }
        else
        {
            echo"Invalid reset link";
        }

    }
    /*else{
    }*/


?>
</body>    
</html>