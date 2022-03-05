<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}

/*function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}*/

	// function to create a random num to store as the user id 
	function random_num($length)
	{

		$text = ""; # this is an empty string
		if($length < 5) # makes sure length is always 5 or more
		{
			$length = 5;
		}

		$len = rand(4,$length); # the number can be of randmo length from 4 to the max $length we decide earlier. 

		for ($i=0; $i < $len; $i++) { 

			$text .= rand(0,9);# in this for loop with each iteration a random number between (o and 9) will be added to string text to make the user_id
		}

		return $text;
	}
