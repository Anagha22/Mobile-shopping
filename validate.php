<?php

// Error Display, if any

	ini_set('display_errors', 1);
	error_reporting(E_ALL);


// DATABASE CONNECTION

	$servername="localhost";
	$username="root";
	$password="aparna";
	$dbname="E-shopping";
	$tbl_name="stopnshop";

//create connection
	$conn= new mysqli($servername, $username, $password, $dbname);

//check connection

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	echo "connected successfully";


// username and password sent from form 

	$myusername = $_POST['username'];
	$mypassword = $_POST['userpassword'];

// To protect MySQL injection (more detail about MySQL injection)

	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysqli_real_escape_string($conn,$myusername);
	$mypassword = mysqli_real_escape_string($conn,$mypassword);


// user validation

	$sql = "SELECT * FROM $tbl_name WHERE username ='$myusername' AND userpassword ='$mypassword'";
	$result = mysqli_query($conn,$sql);
	$res = mysqli_fetch_assoc($result);

	if (!$result) {
		echo("Error description: " . mysqli_error($conn));
	}

	$count = mysqli_num_rows($result);
	if($count==1) {
		$_SESSION['username'] = "username";
		$_SESSION['password'] ="userpassword";
		header("location:product.php");
	}
	else
		header("location:login.php");
		echo "Wrong username or password";

	if($res['username']==$myusername && $res['userpassword']==$mypassword)
 		echo"You are a validated user.";
	else
    		echo"Sorry, your credentials are not valid, Please try again.";


	mysqli_close($conn);


$sql="SELECT * FROM stopnshop WHERE name='$username' LIMIT 1";
?>


