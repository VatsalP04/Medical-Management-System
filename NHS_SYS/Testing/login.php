<?php
session_start();
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD']== "POST")
{
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name)&& !empty($password) &!is_numeric($user_name)) # trim function (remove any blank spaces)
    {
        $user_name_lower = trim(strtolower($user_name));

        #trim(strtolower($user_name)

        $query = "select * from users where LOWER(user_name) = '$user_name_lower'";
        #use lower function of the username and make the inputted value all lower case
        #trim
        #lower 
        
        $result = mysqli_query($con,$query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data["password"] === $password)
                {
                
                    if($user_data["Role"] == "user") #This just checks if the user of this, current session is an admin or a user. if user then go to the page with patients 
                    {
                        $_SESSION["user_id"] = $user_data["user_id"];    
                        header("Location: homepage/patients.php"); #Directs the user to patients.php file. 
                        die;
                       
                    }
                    if($user_data["Role"] == "admin")
                    #if account role id admin then they can see all the users. 
                    {
                        $_SESSION["user_id"] = $user_data["user_id"];    
                        header("Location: homepage/admin/users.php");
                        die;
                    }
                }

                
            }
        }

        echo "Wrong Password or username";
    }

    else
    { 
        echo "Please enter some valid information!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
            <div style= "font-size: 20px; color: white;text-align:center">Login</div><br>

            
            <div style= "font-size: 15px; color: Black;">Username:</div>

            <input id ="text" type="text" name= "user_name"><br><br>

            <div style= "font-size: 15px; color: Black;">Password:</div>
            <input id ="text" type="password" name="password"><br><br>
            
            <input id= "button"type="submit" value="Login"><br><br>

            <a href="signup.php">Click to Signup</a><br><br>
            
        </form>
    </div>

</body>    
</html>