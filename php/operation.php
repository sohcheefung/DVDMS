<?php
require_once("component.php");
require_once("dbconnect.php");
$con= Createdb();

//create buttom click
if(isset($_POST['create'])){
  createData();
}

if(isset($_POST['update'])){
  updateData();
}

if(isset($_POST['delete'])){
  deleteRecord();
}

if(isset($_POST['deleteall'])){
  deleteAll();
}


function createData(){
  $moviename =textboxValue("movie_name");
  $releaseyear = textboxValue("release_year");
  $moviegenre = textboxValue('movie_genre');
  $movieprice = textboxValue("movie_price");

  if($moviename && $releaseyear && $moviegenre && $movieprice){

    $sql = "INSERT INTO movies (movie_name,release_year,movie_genre,movie_price)
              VALUES('$moviename','$releaseyear','$moviegenre','$movieprice')";

    if(mysqli_query($GLOBALS['con'],$sql)){
      TextNode("success","Record Successfully Inserted...");
    }else{
      TextNode("error","Unable to insert data!");
    }

  }else{
    TextNode("error","Please Provide Data in the Textbox");
  }
}

function textboxValue($value){
  $textbox = mysqli_real_escape_string($GLOBALS['con'],trim($_POST[$value]));
  if(empty($textbox)){
    return false;
  }else{
    return $textbox;
  }
}

//Message
function TextNode($classname,$msg){
  $element="<h6 class='$classname'>$msg</h6>";
  echo $element;
}

//dislay data
function getData(){
  $sql = "SELECT*FROM movies";

  $result = mysqli_query($GLOBALS['con'],$sql);

  if(mysqli_num_rows($result)>0){
    return $result;
  }
}

//update data
function updateData(){
  $movieid= textboxValue("movie_id");
  $moviename = textboxValue("movie_name");
  $releaseyear = textboxValue("release_year");
  $moviegenre = textboxValue("movie_genre");
  $movieprice = textboxValue("movie_price");

  if($moviename && $releaseyear && $moviegenre && $movieprice){
    $sql="UPDATE movies SET movie_name='$moviename',release_year='$releaseyear',movie_genre='$moviegenre',movie_price='$movieprice'WHERE id='$movieid'";

    if(mysqli_query($GLOBALS['con'],$sql)){
      TextNode("success","Data Successfully Updated");
    }else{
      TextNode("error","Unable to Update the Data");
    }
  }else{
      TextNode("error","Select the Data Using the Edit Icon");
  }
}

function deleteRecord(){
  $movieid = (int)textboxValue("movie_id");

  $sql = "DELETE FROM movies WHERE id= '$movieid'";

  if(mysqli_query($GLOBALS['con'],$sql)){
    TextNode("success","Record Deleted Successfully");
    resetID();
  }else{
    TextNode("error","Unable to Delete Record!");
  }
}

function deleteBtn(){
  $result = getData();
  $i = 0;
  if($result){
    while ($row = mysqli_fetch_assoc($result)){
      $i++;
      if($i>3){
        buttonElement("btn-deleteall","btn btn-danger","<i class='fas fa-trash'></i> Delete All","deleteall","");
        return;
      }
    }
  }
}

function deleteAll(){
  $sql = "DROP TABLE movies";

  if(mysqli_query($GLOBALS['con'],$sql)){
    TextNode("success","All Record Deleted Successfully");
    Createdb();
  }else{
    TextNode("error","Something Went Wrong!");
  }
}

//set Id
function setID(){
  $getid=getData();
  $id=0;
  if($getid){
    while ($row = mysqli_fetch_assoc($getid)){
      $id = $row['id'];
    }
  }
  return($id+1);
}

//reset movie id
function resetID(){
    $movieid= textboxValue("movie_id");

    $sql = "SET @count = 0";
    mysqli_query($GLOBALS['con'], $sql);

    $sql2 = "UPDATE movies SET id = @count:= @count + 1";
    mysqli_query($GLOBALS['con'], $sql2);

    $sql3= "ALTER TABLE movies AUTO_INCREMENT = 1";
    mysqli_query($GLOBALS['con'], $sql3);
}
