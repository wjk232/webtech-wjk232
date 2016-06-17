<?php
   include('database.php');
   include('functions.php');
   //session start
   session_start();
   //connect to database
   $conn = connect_db();
   
   //get new user info from $_POST
   $username = sanitizeString($_POST['username']);
   $password = sanitizeString($_POST['password']);
   $name = sanitizeString($_POST['name']);
   $email = sanitizeString($_POST['email']);
   $dob = sanitizeString($_POST['dob']);
   $gender = sanitizeString($_POST['gender']);
   $verification_question = sanitizeString($_POST['verification_question']);
   $verification_answer = sanitizeString($_POST['verification_answer']);
   $location = sanitizeString($_POST['location']);
   $profile_pic = sanitizeString($_POST['profile_pic']);
   
   //hash password
   $hash_password = sanitizeString(password_hash($password,PASSWORD_DEFAULT));
   
   //check for username availability
   $result = mysqli_query($conn,"SELECT * FROM users WHERE Username='$username'");
   $rows = mysqli_num_rows($result);
   if($rows > 0){
      echo "Username already exist. Try a different one.";
      exit();
   }
   
   //Try insert data to database if username is available
   $result_insert = mysqli_query($conn, "INSERT INTO users (Username, Password, Name, email, dob,gender,verification_question,verification_answer,location, profile_pic) 
   VALUES ('$username','$hash_password','$name','$email','$dob','$gender','$verification_question','$verification_answer','$location','$profile_pic')");
   
   //check if insert was okay
   if($result_insert){
      //redirect to login page
      header("Location: login.html");
   }else{
      //throw an error
      echo "Oops! Something went wrong! Please try again!";
   }
   
   
?>