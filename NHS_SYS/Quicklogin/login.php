<?php
session_start();
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
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
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="center">
      <h1>Login</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name = "user_name" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass"><a href="forgotpassword.php">Forgot Password?</a></div>
        <input type="submit" value="Login">
        <div class="signup_link">
          Not a member? <a href="signup.php">Register</a>
        </div>
      </form>
    </div>
   
</body>    
</html>