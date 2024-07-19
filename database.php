<?php
      $server = "localhost";
      $username = "root";
      $password = "";
      $database = "blogs_db";
      
      $con = mysqli_connect($server, $username, $password, $database);
      
      if(!$con){
          die("Error: Unable to connect with database ".mysqli_connect_error());
      }
?>