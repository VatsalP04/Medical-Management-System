<?php
session_start();
    include("connection.php");
    include("functions.php");
    
    if($_SERVER['REQUEST_METHOD']== "POST")
    {
        $user_name = trim($_POST['user_name']);
        $password = $_POST['password'];

        {
            $query = "select * from users where user_name = '$user_name'";

            $result = mysqli_query($con,$query);

            if(!empty($user_name) && !empty($password) & !is_numeric($user_name))
            {  
                if($result && mysqli_num_rows($result) == 0)
                    {
                        if(filter_var($user_name, FILTER_VALIDATE_EMAIL))
                        {

                            if(strlen($password)>6) 
                                {
                                    
                                    if (preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password) && preg_match("/[^£$*@:\#~?><>;@]/", $password)) // Here I have added the validation such that the password must include atleast one letter and at least one number and at least one special character. 

                                    {$user_id =  random_num(20);
                                     //$allChars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                     //$secret_code = rand_chars($allChars,10);
                                        $secret_code = random_num(6);
                                        $query = "insert into users (user_id,user_name,password,secret) values ('$user_id','$user_name','$password','$secret_code')";
                                        mysqli_query($con,$query);

                                        
                                        $to = 'bhavna.patel42@yahoo.co.uk';
                                        $subject = 'Email Verfication';
                                        $message = 'Hi,\n This is test email send by PHP Script';
                                        $headers = 'From: vatsal.lpatel04@gmail.com' . "\r\n" .
                                            'Reply-To: vatsal.lpatel04@gmail.com' . "\r\n" .
                                            'X-Mailer: PHP/' . phpversion();
                                        
                                        mail($to, $subject, $message, $headers);
                                        

                                        header("Location: login.php");
                                        die;}
                                    else
                                    {
                                        echo "must contain atleast one number,letter and at least one special character from the set: ^£$*@:\#~?><>;@ ";
                                    }
                                }
                                else
                                {
                                    echo "Password must be greater than 6 characters long ";
                                }


                        }else 
                            {
                                echo "{$user_name}: Not a valid email"."<br>";
                            }
                            
                    }
                    else
                    {
                        echo "Username already exists.";
                    }
            }
            else
            { 
                echo "Please enter some valid information!";
            }
         }
         
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
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
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}
	</style>
    <div id="box">
        <form method = "post">
            <div style= "font-size: 20px;margin: 10px; color: white;">Signup</div>

            <div style= "font-size: 15px; color: Black;">Email:</div>
            <input id ="text" type="text" name= "user_name"><br><br>

            <div style= "font-size: 15px; color: Black;">Password:</div>
            <input id ="text" type="password" name="password"><br><br>
            
            <input id= "button"type="submit" value="Signup"><br><br>
            <a href="login.php">Click to Login</a><br><br>
            
        </form>
    </div>

</body>    
</html>