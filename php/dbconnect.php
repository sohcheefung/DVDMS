<?php

function Createdb(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "dvdms";

  // create connection database
  $con = mysqli_connect($servername, $username, $password);

  // check connection
  if(!$con){
    die("Connection Failed:".mysqli_connect_error());
  }

  //create database
  $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

  if(mysqli_query($con,$sql)){
    $con = mysqli_connect($servername, $username, $password, $dbname);

          $sql='CREATE TABLE IF NOT EXISTS users(
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR (255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL);';
                mysqli_query($con,$sql);

                $sql="CREATE TABLE IF NOT EXISTS movies(
                      id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      movie_name VARCHAR (25) NOT NULL,
                      release_year INT(11),
                      movie_genre VARCHAR(20),
                      movie_price FLOAT
                      );
                  ";

                  if(mysqli_query($con, $sql)){
                    return $con;
                  }else{
                    echo "Cannot Create table...!";
                  }
  }else{
    echo "Error while creating database".mysqli_error($con);
  }
}
 ?>
