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

<?php 

session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//if something was posted the variable $user_name and $password will store the inputted values. 
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		{
			
			
			if(!empty($user_name) && !empty($password) && !is_numeric($user_name)) //these are the validations that are required for variables to be stored on the table.
			{	// This will query the database to see if there is another username with the same username
				$query = "select * from users where user_name = '$user_name'"; 
				
				$result = mysqli_query($con,$query);
				
				//Only if there is no username with inputted value then it will store it on database.  
				if($result && mysqli_num_rows($result) == 0)
				{
					//a random user id is created by using the function random_num which is accessed from the functions.php
					$user_id = random_num(20);

					//This query will save the values to database
					$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
					
					//This is the function to connect and execute the query
					mysqli_query($con, $query);
					//once connected and saved to database this signup page will go to login page.
					header("Location: login_v1.php");
					die;
				}else
				{
					echo "username already exists";
				}
			}else
			{	//If there was an issue with the above if statement then it will tell the user to enter some valid info. 
				echo "Please enter some valid information!";
			}
		}
	}

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];


		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			$user_id = random_num(20);
			echo"$user_id";
			
		}
		else
		{
			echo"Please enter some valid information!";
		}
	}
?>


	<div id="box"> <!-- this tag creates a division/ section for the sign up box -->
		
		<form method="post"> <!-- the method is set to POST so input data can be sent to a server to update table.-->
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>
			
			<!-- these are input fields and has a name so whatever is input here, can be stored in the named variable -->

            <div style= "font-size: 15px; color: Black;">Username:</div>
			<input id="text" type="text" name="user_name"><br><br> 

            <div style= "font-size: 15px; color: Black;">Password:</div>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Signup"><br><br> <!--This is a button instead of a field, when this is clicked the data is said to be "POSTED" -->

			<a href="login_v1.php">Click to Login</a><br><br> <!-- When this hyperlink is pressed it takes the users to the login page to access the website --> 
		</form>
	</div>
</body>
</html>