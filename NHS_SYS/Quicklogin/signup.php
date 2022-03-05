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

            if(!empty($user_name) && !empty($password) & !is_numeric($user_name)) //these are the validations that are required for variables to be stored on the table.
            {  
                if($result && mysqli_num_rows($result) == 0)// This will query the database to see if there is another username with the same username

                    {
                        if(filter_var($user_name, FILTER_VALIDATE_EMAIL))
                        {

                            if(strlen($password)>6) 
                                {
                                    
                                    if (preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $password))
                                     // Here I have added the validation such that the password must include atleast one letter and at least one number and at least one special character. 

                                    {$user_id =  random_num(20);
                                    
                                    $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
                                    $result= mysqli_query($con,$query); // executes the sql query
                                        if ($result) // only if the my sql query is performed.. 
                                        {
                                            header("Location: login.php");// then direct them to login page
                                            die;
                                        }
                                        else{
                                            echo"Didn't update the table, Please try again!";
                                        }
                                    }
                                    else
                                    {
                                        echo "Password must contain atleast one number,letter and at least one special character";
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
    <title>Register</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="center">
      <h1>Register</h1> 
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
        <input type="submit" value="Register">
        <div class="signup_link">
          Already a member? <a href="login.php">Login</a>
        </div>
      </form>
    </div>

</body>    
</html>