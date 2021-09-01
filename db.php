<?php 
 $servername= "localhost";
 $database= "company";
 $username= "root";
 $password= "";
 
 //create connection
 $conn = mysqli_connect($servername, $username, $password, $database);
 
 //check connection
 
 if ($conn->connect_error){
	 die("Connection failed:" .$conn->connect_error);
 }
 
// echo "Connection Successful";
 
 //mysqli_close($conn);
 
?>