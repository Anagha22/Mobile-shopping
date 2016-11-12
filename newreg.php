<?php
$hostname = "localhost";
$user = 'root';
$password = 'aparna';
$db = 'E-shopping';

//connection to db
$conn = mysqli_connect("$hostname", "$user", "$password", "$db")or die(mysqli_error());
mysqli_select_db($conn, "peanat")or die(mysqli_error());


    $username = $_POST['username'];
    $password = $_POST['userpassword'];

    $username =  strtolower(trim($_POST["username"])); 
    $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
    $checkUsername = mysqli_query($conn, "Select username * FROM stopnshop WHERE Username='$username'");
    $numrows = mysqli_num_rows($checkUsername);

        if($numrows!==1) {
        echo "Username not available";
    }else{
        $sql = "INSERT INTO 'stopnshop' ('Username', 'Password') VALUES ('$username', '$password')";

        if(!mysqli_query($conn, $sql)) {
            die(mysqli_error());
        } else {
             echo "1 record added";
        }
    }
?>