<?php
require_once("php/dbconnect.php");
$con= Createdb();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport">
  <title>DVDMS - Login/SignUp</title>
  <script src="https://kit.fontawesome.com/1f324ff0f6.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <style type = text/css>
  .errorMessage{
    background: #F2DEDE;
    color: #A94442;
    padding: 10px;
    width: 100%;
    border-radius: 5px;
    margin: 20px auto;}
    .successMessage{
      background: #D4EDDA;
      color: #40754C;
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      margin: 20px auto;}
    </style>
  </head>

  <body>
    <div class="container text-center">
      <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-film"></i> DVD Management System</h1>
    </div>
    <div class="container d-flex justify-content-center align-items-center">
      <form class="border shadow p-3 rounded bg-body" style="width: 450px;" action="php/signup_check.php" method="post">
        <h1 class="text-center p-3">SIGN UP</h1>
        <?php if(isset($_GET['error'])) { ?>
          <p class="errorMessage"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php if(isset($_GET['success'])) { ?>
          <p class="successMessage"><?php echo $_GET['success']; ?></p>
        <?php } ?>

        <div class="mb-3">
          <label for="name" class="form-label">FULL NAME</label>
          <?php if (isset($_GET['name'])){?>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your fullname" value="<?php echo $_GET['name']; ?>">
          <?php }else{ ?>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your fullname">
          <?php }?>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">EMAIL</label>
          <?php if (isset($_GET['name'])){?>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address" value="<?php echo $_GET['email']; ?>">
          <?php }else{ ?>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address">
          <?php }?>
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
          <p>Already register? <a href="index.php" class="link-primary text-start">Login here</a></p>
        </div>
        <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-user-plus" aria-hidden="true"></i> SIGN UP</button>
      </div>
      </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
  </html>
