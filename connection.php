<?php
//Database Connection

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gender = $_POST['Gender'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($firstname) || !empty($lastname) || !empty($gender) || !empty($email) || !empty($password))
{
	$host = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "signup";

	$conn= new mysqli($host, $dbusername, $dbpassword, $dbname);

	if(mysqli_connect_error())
	{
		die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
	}
	else
	{
		$q = "SELECT email From register Where email = ? Limit 1";
		$ins = "INSERT Into register (firstname, lastname, gender, email, password) values(?, ?, ?, ?, ?)";

		$stmt = $conn->prepare($q);
		$stmt->bind_param("s",$email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();
		$rnum = $stmt->num_rows();

		if($rnum==0)
		{
			$stmt->close();

			$stmt= $conn->prepare($ins);
			$stmt->bind_param("sssss", $firstname, $lastname, $gender, $email, $password);
			$stmt->execute();
			header('location: login.html');
		}
		else
		{
			echo "Someone Already register using this email";
		}
		$stmt->close();
		$conn->close();
	}
}
else
{
	echo "All fields are required";
	die();
}
?>
