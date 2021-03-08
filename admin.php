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
<title>DVD Store - Home</title>
<script src="https://kit.fontawesome.com/1f324ff0f6.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<!--Custom stylesheet-->
<link rel="stylesheet" href="style.css">
</head>

<body>
<main>
  <div class="container text-center">
    <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-film"></i> DVD Store</h1>
    <div class="text-start">
    <p class="fw-bold">Hello,<?php echo $_SESSION['name']; ?></p>
    <div class="row pt-0">
    <a href="changepassword.php" class="link-primary">Change Password</a>
    <a href="php/logout.php" class="link-danger">Logout</a>
    </div>
    </div>
    <div class="d-flex justify-content-center">
      <form action="" method="post" class="w-50">
        <div class="pt-2">
          <?php inputElement("<i class='fas fa-id-badge'></i>","ID","movie_id",setID()); ?>
        </div>
        <div class="row pt-2">
          <div class="col">
          <?php inputElement("<i class='fas fa-compact-disc'></i>","Movie Name","movie_name",""); ?>
         </div>
         <div class="col">
         <?php inputElement("<i class='fas fa-calendar'></i>","Year","release_year",""); ?>
        </div>
        </div>
        <div class="row pt-2">
          <div class="col">
            <?php inputElement("<i class='fas fa-tv'></i>","Genre","movie_genre",""); ?>
          </div>
          <div class="col">
            <?php inputElement("<i class='fas fa-dollar-sign'></i>","Price","movie_price",""); ?>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <?php buttonElement("btn-create","btn btn-success","<i class='fas fa-plus'></i>","create","dat-toggle='tooltip'data-placement='bottom'title='Create'"); ?>
          <?php buttonElement("btn-read","btn btn-primary","<i class='fas fa-sync'></i>","read","dat-toggle='tooltip'data-placement='bottom'title='Refresh'"); ?>
          <?php buttonElement("btn-update","btn btn-light border","<i class='fas fa-pen-alt'></i>","update","dat-toggle='tooltip'data-placement='bottom'title='Update'"); ?>
          <?php buttonElement("btn-delete","btn btn-danger","<i class='fas fa-trash-alt'></i>","delete","dat-toggle='tooltip'data-placement='bottom'title='Delete'"); ?>
          <?php deleteBtn();?>
        </div>
      </form>
    </div>

    <!--Bootstrap table-->
    <div class="d-flex table-data">
      <table class="table table-striped table-dark">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Movie Name</th>
            <th>Release Year</th>
            <th>Genre</th>
            <th>Price (RM)</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody id="tbody">
          <?php
            //displayHello();
            $result = getData();
            if($result){
              while($row = mysqli_fetch_assoc($result)){?>
                <tr>
                  <td data-id="<?php echo $row['id'];?>"><?php echo $row['id'];?></td>
                  <td data-id="<?php echo $row['id'];?>"><?php echo $row['movie_name'];?></td>
                  <td data-id="<?php echo $row['id'];?>"><?php echo $row['release_year'];?></td>
                  <td data-id="<?php echo $row['id'];?>"><?php echo $row['movie_genre'];?></td>
                  <td data-id="<?php echo $row['id'];?>"><?php echo $row['movie_price'];?></td>
                  <td><i class="fas fa-edit btnedit" data-id="<?php echo $row['id'];?>"></i></td>
                </tr>
                <?php
              }
            }

           ?>
        </tbody>
      </table>
    </div>
  </div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="php/javascript.js"></script>
<script src="sweetalert2.all.min.js"></script>
</body>
</html>

<?php
}else {
      header("Location: index.php");
      exit();
}
 ?>
