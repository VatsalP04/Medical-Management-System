<?php
    include("connection.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function sendMail($email,$secret_code)
    {
        require('PHPMailer/Exception.php');
        require('PHPMailer/SMTP.php');
        require('PHPMailer/PHPMailer.php');


        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = '#';                     //SMTP username
            $mail->Password   = '#';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('vp9574962@gmail.com', 'Vatsal');
            $mail->addAddress($email);//Add a recipient
        
            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Testing';
            $mail->Body    = "We got a request from you to reset your password <b>Click the link below:</b>'
            <a href='http://localhost:8888/NHS_SYS/Quicklogin/updatepassword.php?email=$email&secret_code=$secret_code'>Reset Password</a>";
        
            $mail->send();
            return true;
        } catch (Exception $e)
        {
            return false;
        }
    }

    if(isset($_POST["send-reset-link"])) //checks if something was posted. 
    {  
        $email = $_POST['email']; //if posted then set input email as variable email.
        
        if(!empty($email)) // validates email, if not empty
        {
            $query = "SELECT * FROM users WHERE user_name = '$email'"; // make a query which will check if there is an email on table the same as input email.
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) == 1 ) // if valid email
            {

                $secret_code = bin2hex(random_bytes(3));

                $stmt= "UPDATE users SET secret_code = '$secret_code' WHERE user_name = '$email' ";
                $res= mysqli_query($con,$stmt);
                
                if ($res && sendMail($email,$secret_code)){
                    echo"Email sent ";
                    }
                else{
                    echo "no email";
                    }   

            }
            else{
                echo"Invalid email.";
            }

        }
        else{
            echo "Please enter some valid information!";
        }
    }

    
?>

<!DOCTYPE html>
<html>
<head>
	<title>Send Email</title>


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


    <div id="box">
        <form method = "post"> 
            <div style= "font-size: 20px; color: white;text-align:center">Reset Password</div><br>

            <div style= "font-size: 15px; color: Black;">Email:</div>

            <input id ="text" type="text" name= "email"><br><br> 

            <div style= "text-align:center">
            <input id= "button"type="submit" name="send-reset-link" value="Send Email"> 
            </div>
        </form>
    </div>
    
    <div style="text-align:center">    
    <p></p><a href="login.php">Click to Login</a>
    </div> 

    <!--<div class="center">
      <h1>Reset Password</h1>
      <form method="post"> 
        <div class="txt_field">
          <input id ="text" type="text" name = "email" required> 
          <span></span>
          <label>Email</label>
        </div>
        <input type="submit" name="send-reset-link" value="Send Reset link"> 
        <div class="signup_link">
          <a href="login.php"> Click to Login </a>
        </div>
      </form>
    </div>
    </div>-->
   
</body>    
</html>
