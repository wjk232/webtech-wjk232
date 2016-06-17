<?php
   include('database.php');
   include('functions.php');
   
   //start session
   session_start();
   
   //connect to database
   $conn = connect_db();
   
   //get values from $_POST
   $PID = sanitizeString($_POST['PID']);
   $UID = sanitizeString($_POST['UID']);
   $name = sanitizeString($_POST['name']);
   $comment = sanitizeString($_POST['comment']);
   $profile_pic = sanitizeString($_POST['profile_pic']);
   
   //Try to insert into comments table
   $result_insert = mysqli_query($conn,"INSERT INTO comments(PID,comment,UID,name,profile_pic)
   VALUES ('$PID','$comment','$UID','$name','$profile_pic')");
      
   //check if insert was okay
   if($result_insert){
      //redirect to feed page
      header("Location: feed.php");
   }else{
      //throw an error
      echo "Oops! Something went wrong! Please try again!";
   }
?>