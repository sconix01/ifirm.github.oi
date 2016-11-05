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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
  $loginUsername=$_POST['Username'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "Userlevel";
  $MM_redirectLoginSuccess = "templet.php";
  $MM_redirectLoginFailed = "Login.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_Localhost, $Localhost);
  	
  $LoginRS__query=sprintf("SELECT Username, Password, Userlevel FROM persons WHERE Username=%s AND Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $Localhost) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'Userlevel');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/menu3.css" rel="stylesheet" type="text/css"/>
<link href="CSS/layout.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/popup.css"/>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<title>i-Firm</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<div id="Holder">
<div id="Header"></div>
<div id="NavBar></div>
<div id="Content">
<nav>
	<ul>
		<li><a href="Register.php">Register now!!</a></li>
  		<li><a href="Recovery.php">Forgot Password</a></li>
	</ul>
</nav>
<div id="Registerboxn">
	<div class="popupBoxWrapper">
						<div class="popupBoxContent">
                        <form action="<?php echo $loginFormAction; ?>" method="POST" id="LoginForm"><table width="400" border="1">
  <tr>
    <td><h5><span id="sprytextfield1">
      <label for="Username2"></label>
      Username <br />
      <input type="text" name="Username" id="Username2" />
    </span></h5>
      <span><span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h5><span id="sprypassword1">
      <label for="Password"></label>
      Password <br />
      <input type="password" name="Password" id="Password" />
    </span></h5>
      <span><span class="passwordRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td> <div class="g-recaptcha" data-sitekey="6LdCnAoUAAAAADHttnOky9LiUumCKTK3vnQXmrc4"></div> &nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="Login" id="Login" value="Login" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
              </div>
    </div>
</div>
<div id="Footer"></div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>
</body>
</html>