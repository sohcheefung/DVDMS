<?php
require_once("php/operation.php");
require_once("php/component.php");
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['email'])){
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport">
<title>DVDMS - Change Password</title>
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
    <form class="border shadow p-3 rounded bg-body" style="width: 450px;" action="php/change_password.php" method="post">
      <h1 class="text-center p-3">Change Password</h1>
      <?php if(isset($_GET['error'])) { ?>
        <p class="errorMessage"><?php echo $_GET['error']; ?></p>
      <?php } ?>
      <?php if(isset($_GET['success'])) { ?>
        <p class="successMessage"><?php echo $_GET['success']; ?></p>
      <?php } ?>
      <div class="mb-3">
        <label for="oldpassword" class="form-label">OLD PASSWORD</label>
        <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="Enter your old password">
      </div>
      <div class="mb-3">
        <label for="newpassword" class="form-label">NEW PASSWORD<i class="fw-light"> *minimum length of 6 characters</i></label>
        <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Enter your new password">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">CONFIRM NEW PASSWORD</label>
        <input type="password" class="form-control" name="cnpassword" id="cnpassword" placeholder="Confirm your new password">
      </div>
      <div class="mb-3">
        <a href="admin.php" class="link-primary text-start">BACK</a>
      </div>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">CHANGE</button>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>

<?php
}else {
      header("Location: index.php");
      exit();
}
 ?>
