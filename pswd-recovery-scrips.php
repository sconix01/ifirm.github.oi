<?php @session_start(); $_SESSION ['Recovery'] = $_POST['Email']; ?>
<?php require_once('Connections/Localhost.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) { 
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_EmailPassword = "-1";
if (isset($_SESSION['Recovery'])) {
  $colname_EmailPassword = $_SESSION['Recovery'];
}
mysql_select_db($database_Localhost, $Localhost);
$query_EmailPassword = sprintf("SELECT * FROM persons WHERE Email = %s", GetSQLValueString($colname_EmailPassword, "text"));
$EmailPassword = mysql_query($query_EmailPassword, $Localhost) or die(mysql_error());
$row_EmailPassword = mysql_fetch_assoc($EmailPassword);
$totalRows_EmailPassword = mysql_num_rows($EmailPassword);
?>

<?php
mysql_free_result($EmailPassword);
?>
<?php

if ($totalRows_EmailPassword > 0) {

$from="noreply@yourdomain.com";
$email=$_POST['Email'];
$subject="Your Doimain-Email Password";
$message="Here is your Password:".$row_EmailPassword['Password'];

mail( $email, $subject, $message, "From:".$from);
}
	if($totalRows_EmailPassword > 0) {
		echo "Please Check your email , your password have been send";
		
	} else {
		echo"Fail -Please try again!";
	}



?>