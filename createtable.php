<?php
$con=mysqli_connect("localhost","root","","ifirm");
// Check connection
if (mysqli_connect_error())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create table
$sql="CREATE TABLE Persons(FirstName CHAR(30),LastName CHAR(30),Username CHAR(30),Email CHAR(30),Password INT)";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Table persons created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error($con);
  }
?>
