<?php
   //access database
   include('database.php');
   include('functions.php');
   session_start();
   
   //connect to database
   $conn = connect_db();
   
   //get values from $_POST
   $content = sanitizeString($_POST['content']);
   $UID = sanitizeString($_POST['UID']);
   
   //query DB for this user
   $result = mysqli_query($conn, "SELECT * FROM users WHERE id='$UID'");
   $row = mysqli_fetch_assoc($result);
   
   //Fetch user information
   $name = sanitizeString($row['Name']);
   $profile_pic = sanitizeString($row['profile_pic']);
   
   //Try to insert into posts table
   $result_insert = mysqli_query($conn, "INSERT INTO posts(content, UID, name, profile_pic, likes) 
      VALUES ('$content',$UID,'$name','$profile_pic',0)");
   
   //check if insert was okay
   if($result_insert){
      //redirect to feed page
      header("Location: feed.php");
      
   }else{
      //throw an error
      echo "Oops! Something went wrong! Please try again!";
   }
   
?>