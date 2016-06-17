<?php
   include('database.php');
   include('functions.php');
   $conn = connect_db();
   //get data from the form
   $PID = sanitizeString($_POST['PID']);
   
   //query DB for thos Post
   $result = mysqli_query($conn, "SELECT * FROM posts WHERE id='$PID'");
   $row = mysqli_fetch_assoc($result);
   $likes = sanitizeString($row['likes']);
   
   //update likes
   $likes = $likes + 1;
   
   $result = mysqli_query($conn, "UPDATE posts SET likes='$likes' WHERE id='$PID' ");
   
   //check if Update was Success
   if($result){
      header('Location: feed.php');
   }else{
      echo "Something went wrong";
   }
   
?>