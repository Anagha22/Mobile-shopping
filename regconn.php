<?php

	// Error Display, if any

	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	
	// Database Connection

	//if(isset($_POST['submit'])) {

	$servername="localhost";
	$username="root";
	$password="aparna";
	$dbname="E-shopping";
	$tbl_name="stopnshop";

//create connection
	$conn= new mysqli("$servername", "$username", "$password", "$dbname");

//check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	}
	echo "connected successfully";

	$name = $_POST['username'];
	$mail = $_POST['email'];
	$password = $_POST['userpassword'];


// To protect MySQL injection (more detail about MySQL injection)

	$myusername = stripslashes($name);
	$mypassword = stripslashes($password);
	$mail = stripslashes($mail);
	$myusername = mysqli_real_escape_string($conn,$myusername);
	$mypassword = mysqli_real_escape_string($conn,$mypassword);
	$mail = mysqli_real_escape_string($conn,$mail);


	$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and userpassword='$mypassword'";
	$result=mysqli_query($conn,$sql);
	$res = mysqli_fetch_assoc($result);
	
	

// Mysql_num_row is counting table row

	$count=mysqli_num_rows($result);
	echo $count;
	if($count==0) {
		$_SESSION['username'] = "username";
		$_SESSION['userpassword'] ="mypassword"; 
		$_SESSION['email'] = "mail";

		$sql1 = "INSERT INTO E-shop (username,userpassword,email) VALUES ('$myusername', '$mypassword', '$mail')";
		$result1=mysqli_query($conn,$sql1);
		$res1 = mysqli_fetch_assoc($result1);	
		echo $res1;
		//header("location:product.php");
		//if ($result1) {	//	echo("Error description: " . mysqli_error($conn));
	//}
	}
	else 
		echo "Username or Password or email already existing";

	if ($conn->query($sql1) === TRUE)  
		echo "New record created successfully";
	else
		echo "Error: " . $sql1 . "<br>" . $conn->error;  
//}
?>

