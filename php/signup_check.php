<?php
session_start();
require_once("dbconnect.php");
$con= Createdb();

if(isset($_POST['name']) && isset($_POST['email'])
&& isset($_POST['password']) && isset($_POST['confirmpassword'])){
  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $name = validate($_POST['name']);
  $email = validate($_POST['email']);
  $password = validate($_POST['password']);
  $confirmpassword = validate($_POST['confirmpassword']);

  $user_data = 'name='. $name. '&email='.$email;

  if(empty($name)){
    header("Location: ../signup.php?error=Fullname is required&$user_data");
    exit();
  }else if (empty($email)) {
    header("Location: ../signup.php?error=Email is required&$user_data");
    exit();
  }else if (empty($password)) {
    header("Location: ../signup.php?error=Password is required&$user_data");
    exit();
  }else if (strlen($password)<6){
    header("Location: ../signup.php?error=Password minimum length of 6 characters!&$user_data");
    exit();
  }else if (empty($confirmpassword)) {
    header("Location: ../signup.php?error=Please confirm your password&$user_data");
    exit();
  }else if ($password !== $confirmpassword){
    header("Location: ../signup.php?error=Password does not match&$user_data");
    exit();
  }
  else {
    //hashing the password
    $password = md5($password);
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result)>0){
      header("Location: ../signup.php?error=This email has been registered!&$user_data");
      exit();
    }else{
      $sql2 = "INSERT INTO users(name,email,password) VALUE('$name','$email','$password')";
      $result2 = mysqli_query($con,$sql2);
      if ($result2) {
        header("Location: ../signup.php?success=Your account has been successfully created!");
        exit();
      }else{
        header("Location: ../signup.php?error=Unable to create account, Please try again!&$user_data");
        exit();
      }
    }
  }

}else{
  header("Location: ../signup.php");
  exit();
}


?>
