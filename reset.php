<?php
require_once("php/dbconnect.php");
$con= Createdb();
if(isset($_GET['token'])){
  $token = mysqli_real_escape_string($con, $_GET['token']);
  $query = "SELECT * FROM password_reset WHERE token='$token'";
  $run = mysqli_query($con, $query);
  if(mysqli_num_rows($run)>0){
    $row = mysqli_fetch_array($run);
    $token = $row['token'];
    $email = $row['email'];
  }else{
    header("Location:index.php");
  }
}
if(isset($_POST['submit'])){
  $password = mysqli_real_escape_string($con,$_POST['password']);
  $confirmpassword = mysqli_real_escape_string($con,$_POST['confirmpassword']);
  if(empty($password)){
    $msg = "<div class='alert alert-danger'>Password is required!</div>";
  }else if(empty($confirmpassword)){
    $msg = "<div class='alert alert-danger'>Please confirm your password!</div>";
  }else if($password !== $confirmpassword){
    $msg = "<div class='alert alert-danger'>Password do not match!</div>";
  }else if(strlen($password)<6){
    $msg = "<div class='alert alert-danger'>Password minimum of 6 characters!</div>";
  }else if(strlen($confirmpassword<6)){
    $msg = "<div class='alert alert-danger'>Password minimum of 6 characters!</div>";
  }else{
    $password = md5($password);
    $confirmpassword = md5($confirmpassword);
    $query = "UPDATE users SET password='$password' WHERE email='$email'";
    mysqli_query($con, $query);
    $query = "DELETE FROM password_reset WHERE email='$email'";
    mysqli_query($con, $query);
    $msg = "<div class='alert alert-success'>Password updated!</div>";
  }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport">
  <title>DVDMS - Reset Password</title>
  <script src="https://kit.fontawesome.com/1f324ff0f6.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  </head>
  <body>
    <div class="container text-center">
      <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-film"></i> DVD Management System</h1>
    </div>
    <div class="container d-flex justify-content-center align-items-center">
      <form class="border shadow p-3 rounded bg-body" style="width: 450px;" action="" method="post">
        <h1 class="text-center p-3">RESET PASSWORD</h1>
        <?php if(isset($msg)){ echo $msg;} ?>
        <div class="mb-3">
          <label for="email" class="form-label fw-normal">EMAIL</label>
          <input type="text" readonly class="form-control" name="email" id="email" value="<?php echo $email; ?>">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">PASSWORD<i class="fw-light"> *minimum length of 6 characters</i></label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
        </div>
        <div class="mb-3">
          <label for="confirmpassword" class="form-label"> CONFIRM PASSWORD</label>
          <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm your password">
        </div>
        <div class="mb-3">
          <a href="index.php" class="link-primary text-start">HOME</a>
        </div>
        <div class="mb-3 d-grid gap-2">
        <button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fas fa-sign-in-alt"></i> CONFIRM</button>
        </div>
      </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="php/javascript.js"></script>
  </body>
  </html>
