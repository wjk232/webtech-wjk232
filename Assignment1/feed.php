<!DOCTYPE html>
<html>
<head>
   <title>MyFacebook Feed</title>
</head>
<body>
   <?php
      include('database.php');
      //start session
      session_start();
      
      //connect to database
      $conn = connect_db();

      $username = $_SESSION['username'];
      
      //query DB for this user
      $result = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");
      $row_users = mysqli_fetch_assoc($result);
      
      //display User's Picture and name
      echo "<h1>Welcome back " .$row_users['Name']. "!</h1>";
      echo "<img  src='" .$row_users['profile_pic']. "'>";
      echo "<br> <br>";
      
      //posts form
      echo "<form action='posts.php' method='POST'>";
      echo "<textarea name='content' placeholder='Post Something...'></textarea>";
      echo "</p><input type='hidden' name='UID' value='$row_users[id]'>";
      echo "<p><input type='submit'></p>";
      echo "</form>";      
      echo "<br>";
      
      $result_posts = mysqli_query($conn,"SELECT * FROM posts");
      $num_of_rows = mysqli_num_rows($result_posts);
      
      //display post and comments
      echo "<h2 style='padding-left:50px;'>My Feed</h2>";
      for($i = 0; $i < $num_of_rows; $i++){
         
         //display image and posts
         $row = mysqli_fetch_row($result_posts);
         echo "<div style='background-color:#f1f1f1; width:300px;'>";
         echo "<img src='$row[4]' height='30' width='40'>";
         echo "<b>$row[3]:</b><br>$row[1]";
         
         //likes form
         echo "<form action='likes.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'>
               <input type='submit' value='Like' style='font-size:65%; padding:0px;'> $row[5]</form>";
               
         //query DB for current post
         $result_comments = mysqli_query($conn,"SELECT * FROM comments WHERE PID='$row[0]'");
         $num_of_rows_cmt = mysqli_num_rows($result_comments);

         //fetch rows and print comments
         for($j = 0; $j < $num_of_rows_cmt; $j++)
         {
            $row_cmt = mysqli_fetch_row($result_comments);
            echo"    ";
            echo "<p style='padding-left:30px;font-size:85%;' ><img src='$row_cmt[4]' height='23' width='35'>";
            echo "<b>$row_cmt[3]</b>: $row_cmt[1]</p>";
         }
         
         //form for comments
         echo "<form action='comments.php' method='POST'>";
         echo "<p><textarea name='comment' placeholder='Write a comment...' style='width:290px;'></textarea>";
         echo "<input type='hidden' name='PID' value='$row[0]'>";
         echo "<input type='hidden' name='UID' value='$row_users[id]'>";
         echo "<input type='hidden' name='name' value='$row_users[Name]'>";
         echo "<input type='hidden' name='profile_pic' value='$row_users[profile_pic]'>";                                  
         echo "<input type='submit'></p>";
         echo "</form>";        
         echo "</div><br><br>";
      }
   ?>
  
</body>
</html>
