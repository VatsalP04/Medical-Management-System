<?php

function check_login($con)
{
    if(isset($_SESSION["user_id"]))
    {
        $id = $_SESSION["user_id"];
        $query = "select * from users where user_id = $id limit 1";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    header("Location: login.php");
    die;
}

function random_num($length)
{
    $text= "";
    if($length < 6)
    {
        $length=6;
    }

    $len=rand(6,$length);

    for ($i=0; $i < $len; $i++)
    {
        $text .=rand(0,9);
    }

    return $text;

}

function rand_chars($length) {
    $allChars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $sameCharBesides =FALSE
    if (!$sameCharBesides) for ($string = '', $i = 0, $z = strlen($c)-1; $i < $length; $x = rand(0,$z), $string .= $c{$x}, $i++);
    else for ($i = 0, $z = strlen($c)-1, $string = $c{rand(0,$z)}, $i = 1; $i != $length; $x = rand(0,$z), $string .= $c{$x}, $string = ($string{$i} == $string{$i-1} ? substr($string,0,-1) : $string), $i=strlen($string));
    return $string;
    }