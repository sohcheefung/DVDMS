<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['email'])){
  require_once("dbconnect.php");
  $con= Createdb();

  if(isset($_POST['oldpassword']) && isset($_POST['newpassword'])
  && isset($_POST['cnpassword'])){
    function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $oldpassword = validate($_POST['oldpassword']);
    $newpassword = validate($_POST['newpassword']);
    $cnpassword = validate($_POST['cnpassword']);

    if(empty($oldpassword)){
      header("Location: ../changepassword.php?error=Old password is required!");
      exit();
    }else if(empty($newpassword)){
      header("Location: ../changepassword.php?error=New password is required!");
      exit();
    }else if(strlen($newpassword)<6){
      header("Location: ../changepassword.php?error=Password minimum length of 6 characters!");
      exit();
    }else if ($newpassword !== $cnpassword) {
      header("Location: ../changepassword.php?error=New password does not match!");
      exit();
    }else {
      //hashing the password
      $oldpassword = md5($oldpassword);
      $newpassword = md5($newpassword);
      $id = $_SESSION['id'];

      $sql = "SELECT password FROM users WHERE id='$id' AND password='$oldpassword'";
      $result = mysqli_query($con,$sql);
      if(mysqli_num_rows($result) === 1){
        $sql2 ="UPDATE users SET password='$newpassword' WHERE id ='$id'";
        mysqli_query($con, $sql2);
        header("Location: ../changepassword.php?success=Your password has been changed successfully!");
        exit();
      }else{
        header("Location: ../changepassword.php?error=Incorrect password entered!");
        exit();
      }
    }



}else {
  header("Location: ../changepassword.php");
  exit();
}

}else {
      header("Location: ../index.php");
      exit();
}

 ?>
