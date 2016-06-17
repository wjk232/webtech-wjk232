<?php

   function destroySession()
   {      
      $_SESSION=array();
      
      if(session_id() != "" || isset($_COOKIE[session_name()]))
         setcookie(session_name(), '', time()-2592000, '/');
      
      session_destroy();
   }
   
   function sanitizeString($var)
   {
      $conn = connect_db();
      $var = strip_tags($var);
      $var = htmlentities($var);
      $var = stripslashes($var);
      return mysqli_real_escape_string($conn,$var);
   }
  
?>