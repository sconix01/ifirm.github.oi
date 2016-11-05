<?php @session_start(); ?>
<?php require_once('Connections/Localhost.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "Login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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

$colname_LogOut = "-1";
if (isset($_GET['MM_Username'])) {
  $colname_LogOut = $_GET['MM_Username'];
}
mysql_select_db($database_Localhost, $Localhost);
$query_LogOut = sprintf("SELECT * FROM persons WHERE Username = %s", GetSQLValueString($colname_LogOut, "text"));
$LogOut = mysql_query($query_LogOut, $Localhost) or die(mysql_error());
$row_LogOut = mysql_fetch_assoc($LogOut);
$totalRows_LogOut = mysql_num_rows($LogOut);

$colname_user = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_user = $_SESSION['MM_Username'];
}
mysql_select_db($database_Localhost, $Localhost);
$query_user = sprintf("SELECT * FROM persons WHERE Username = %s", GetSQLValueString($colname_user, "text"));
$user = mysql_query($query_user, $Localhost) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/layout.css" rel="stylesheet" type="text/css"/>
<link href="CSS/menu.css" rel="stylesheet" type="text/css"/>
<title>i-Firm</title>
</head>
<body>

<div id="Holder">
<div id="Header"></div>
<div id="NavBar">
	<nav>
	<ul>
 		<li><a href="templet.php">Home</a></li>
  		<li><a href="#">About Us </a>
  			<ul>
    			<li><a href="#">History of establishment</a></li>
        		<li><a href="vnm.php">Vission & Mission</a></li>
        		<li><a href="#">Organization chart</a></li>
    		 </ul>
        </li>
  		<li><a href="#">Our Services</a>
        	<ul>
				<li><a href="civil1.php">Civil</a></li>
                <li><a href="#">Syariah</a></li>
            </ul>
        </li>
  		<li><a href="#">Contact Us</a></li>
        <li><a href="Account.php">Update Account</a></li>
  		<li><a href="<?php echo $logoutAction ?>">Logout</a></li>
	</ul>
</nav>                   
</div> 
<div id="Content">
<br>
<br>
<h3 style="color:white;">Welcome&nbsp;<?php echo $row_user['FirstName']; ?> <?php echo $row_user['LastName']; ?></h3>
<p style="color:white;"></p>
<table height="auto" width="1000" border="1" align="center" background="assets/tbg.jpg">
  <tr>
    <td><h2 style="color:#0F9;"> VISI</h2>
<font size="20" font face="Trebuchet MS">Peneraju bantuan guaman yang terunggul di Bangi pada tahun 2018.</font>
<h2 style="color:#0F9;"> Mission</h2>
Menerajui perkhidmatan bantuan guaman secara profesional kepada masyarakat yang berkelayakan bagi menjamin akses kepada keadilan melalui proses perundangan.
 </p></td>
  </tr>
</table>

</div>

<div id="Footer">

</div>
</div>
</body>
</html>
<?php
mysql_free_result($LogOut);

mysql_free_result($user);
?>
