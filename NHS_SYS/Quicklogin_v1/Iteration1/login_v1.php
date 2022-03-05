<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			//read from database by querying the user_name
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result) // if a connection and query is made then..... 
			{
				if($result && mysqli_num_rows($result) > 0) // if there is a list more than 0 with the username inputted then
				{

					$user_data = mysqli_fetch_assoc($result); // user_data is a variable which stores all the selected username from the above query
					
					if($user_data['password'] === $password)// if the password is the same as the input then...
					{
 
						$_SESSION['user_id'] = $user_data['user_id']; //To check if the user is logged in, the user_id on database is equal to the session user_id 
						header("Location: index.php");//If everything is correct go to the index page.
						die;
					}
				}
			}
			
			echo "wrong username or password!"; // if thhere is no user_name in the database then print this.
		}else
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
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<div style= "font-size: 15px; color: Black;">Username:</div>
			<input id="text" type="text" name="user_name"><br><br>
			<div style= "font-size: 15px; color: Black;">Password:</div>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup_v1.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>