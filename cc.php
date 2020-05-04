<?php
$conn = mysqli_connect("localhost", "root","");
    mysqli_select_db($conn,"signup");
	$email = $_POST['email'];
    $password = $_POST['password'];

    $email = stripcslashes($email);
    $password = stripcslashes($password);
    $email = mysqli_real_escape_string($conn,$email);
    $password = mysqli_real_escape_string($conn,$password);

    

    $result = mysqli_query($conn,"select * from register where email = '$email' and password = '$password'") or die("failed".mysql_error());

    $row = mysqli_fetch_array($result);

    if($row['email'] == $email && $row['password'] == $password)
    {
    	if(isset($_POST["login"]))
    	{
    		header('Location: https://ravibhaskar2000.github.io/Restaurant/SE%20project/restaurant%20page/index.html');
    	}
    }
    else
    {
    	if(isset($_POST["login"]))
    	{
    		header('Location: login.html');
    	}
    }
    ?>