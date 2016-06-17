<?php
   //start session
   session_start();
   //get username and password from $_POST
   $username = $_POST['username'];
   $password = $_POST['password'];
   $dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "root";
   $dbname = "mydb";
   
   $conn = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname);
   if( mysqli_connect_errno($conn)){
      echo "Failed to connect to MySQL: " .mysqli_connect_error();
   }

   $result = mysqli_query($conn,"SELECT * FROM users WHERE Username='$username'");
   $row = mysqli_fetch_assoc($result);
   
   //Check in the DB(DataBase)
   if(password_verify($password,$row['Password'])){ 
      //If authenticated: say hello!
      //echo "Success!! Welcome $username";
      //echo "Success!! Welcome ".$username;
      $_SESSION["username"] = $username;
      header("Location: feed.php");
   }else{
      //else ask to login again..
      echo "Invalid password! Try again";
   }
    
   
?>