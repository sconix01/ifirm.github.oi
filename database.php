<?php
$con=mysqli_connect("localhost","root","");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$sql="CREATE DATABASE ifirm";
if (mysqli_query($con,$sql))
  {
  echo "Database i-firm created successfully";
  }
else
  {
  echo "Error creating database: " . mysqli_error($con);
  }
?>
