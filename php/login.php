<?php
session_start();
require_once("dbconnect.php");
$con= Createdb();

if(isset($_POST['email']) && isset($_POST['password'])){
  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $email = validate($_POST['email']);
  $password = validate($_POST['password']);

  if(empty($email)){
    header("Location: ../index.php?error=Email is required");
    exit();
  }else if (empty($password)) {
    header("Location: ../index.php?error=Password is required");
    exit();
  }else {
    //hashing the password
    $password = md5($password);
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) === 1){
      $row = mysqli_fetch_assoc($result);
      if ($row['email'] === $email && $row['password'] === $password){
          $_SESSION['email'] = $row['email'];
          $_SESSION['name'] = $row['name'];
          $_SESSION['id'] = $row['id'];
          header("Location: ../admin.php");
      }else{
        header("Location: ../index.php?error=Unable to login");
        exit();
      }
    }else{
      header("Location: ../index.php?error=Incorrect Username or Password");
      exit();
    }
  }

}else{
  header("Location: ../index.php");
  exit();
}
 ?>
