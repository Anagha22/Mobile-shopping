<?php 
	include "connect.php"; 
	$error=""; 
	$errormsg=""; 
	//check if 
	//A) a bookid has been submitted 
	//B) the submitted value is numeric 
	if(isset($_GET['bid'])){ 
	//clean it up 
	if(!is_numeric($_GET['bid'])){ 
1	//Non numeric value entered. Someone tampered with the bookid 
	$error=true; 
	$errormsg=" Security, Serious error. Contact webmaster: bid enter: ".$_GET['bid'].""; 
	}else{ 
	//book_id is numeric number 
	//clean it up 
	$cbID=mysql_escape_string($_GET['bid']); 
	$query ="SELECT * from books INNER JOIN genres ON genID=gen_id WHERE book_id='".$cbID."' "; 
	$results=mysql_query($query); 
	if($results){ 
	$num = mysql_num_rows($results); 
	$row=mysql_fetch_assoc($results); 
	$authno=$row['authID']; 
	//run a query to get the auth name 
	if($authno > 0){ 
	$query_auth ="SELECT * from author WHERE auth_id='".$authno."' "; 
	$results_auth=mysql_query($query_auth); 
	$row_auth=mysql_fetch_assoc($results_auth); 
	$auth=$row_auth['auth_name']; 
	} 
	}//results 
	else{ 
	//there's a query error 
	$error=true; 
	$errormsg .=mysql_error(); 
	}//result test 
	}//numeric 
	}//if isset 
	?> 
