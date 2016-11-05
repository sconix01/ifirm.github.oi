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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="Register.php";
  $loginUsername = $_POST['Username'];
  $LoginRS__query = sprintf("SELECT Username FROM persons WHERE Username=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_Localhost, $Localhost);
  $LoginRS=mysql_query($LoginRS__query, $Localhost) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "RegisterForm")) {
  $insertSQL = sprintf("INSERT INTO persons (FirstName, LastName, Username, Email, Password) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Password'], "text"));
 


  mysql_select_db($database_Localhost, $Localhost);
  $Result1 = mysql_query($insertSQL, $Localhost) or die(mysql_error());

  $insertGoTo = "Login.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_Localhost, $Localhost);
$query_Register = "SELECT * FROM persons";
$Register = mysql_query($query_Register, $Localhost) or die(mysql_error());
$row_Register = mysql_fetch_assoc($Register);
$totalRows_Register = mysql_num_rows($Register);
?>
<?php
	if(isset($_POST[$Register])){
	$url ='https://www.google.com/recaptcha/api.js';
	$privatey = "6LdCnAoUAAAAADHttnOky9LiUumCKTK3vnQXmrc4";
	
	$response = file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_server['REMOTE_ADDR']);
	$data = json_decode($response);
	
	if(isset($data->success) AND $data->success==true){
		header('Location: Login.php?CaptchaPass=True');
	}else{
		header('Location: Register.php?CaptchaFail=True');
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/layout.css" rel="stylesheet" type="text/css"/>
<link href="CSS/menu3.css" rel="stylesheet" type="text/css"/>
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
		<li><a href="Login.php">Login</a></li>
  		<li><a href="Recovery.php">Forgot Password</a></li
	></ul>
</nav></div>
<div id="Registerboxn">
	<div class="popupBoxWrapper">
						<div class="popupBoxContent">
						  <form id="RegisterForm" name="RegisterForm" method="POST" action="<?php echo $editFormAction; ?>">
						    <table width="400" border="1">
						      <tr>
						        <td><table border="1">
						          <tr>
						            <td width="195"><span id="sprytextfield2">
					                <label for="FirstName4"></label>
FirstName <br />
						              <input type="text" name="FirstName" id="FirstName4" />
					                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
						            <td width="178"><span id="sprytextfield3">
					                <label for="LastName"></label>
LastName <br />
						               <input type="text" name="LastName" id="LastName" />
					                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
					              </tr>
					            </table></td>
					          </tr>
						      <tr>
						        <td>&nbsp;</td>
					          </tr>
						      <tr>
						        <td><span id="sprytextfield4">
					            <label for="Username"></label>
Username <br />
						          <input type="text" name="Username" id="Username" />
					            <span class="textfieldRequiredMsg">Username already exist</span></span></td>
					          </tr>
						      <tr>
						        <td>&nbsp;</td>
					          </tr>
						      <tr>
						        <td><span id="sprytextfield5">
                                <label for="Email"></label>
Email<br />
<input type="text" name="Email" id="Email" />
<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
					          </tr>
						      <tr>
						        <td>&nbsp;</td>
					          </tr>
						      <tr>
						        <td><p>Password</p>
						          <span id="sprypassword2">
                                  <label for="Password"></label>
                                  <input type="password" name="Password" id="Password" />
                                <span class="passwordRequiredMsg">Atless 1 uppercase and min 8 password lenght</span><span class="passwordMaxCharsMsg">Exceeded maximum number of characters.</span><span class="passwordMinCharsMsg">Minimum number of characters not met.</span></span></td>
					          </tr>
						      <tr>
						        <td><span id="sprypassword3">
                                <label for="PasswordConfirmation"></label>
Password Confirmation<br />
<input type="password" name="PasswordConfirmation" id="PasswordConfirmation" />
<span class="passwordRequiredMsg">Atless 1 uppercase and min 8 password lenght</span><span class="passwordMinCharsMsg">Minimum number of characters not met.</span><span class="passwordMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
					          </tr>
						      <tr>
						        <td><div class="g-recaptcha" data-sitekey="6LdCnAoUAAAAADHttnOky9LiUumCKTK3vnQXmrc4"></div> &nbsp;<?php if(isset($_GET['CaptchaPass'])){?>
                                <div class="FormElement"></div>
                                <?php }?>
                                 <?php if(isset($_GET['CaptchaFail'])){?>
                                <div class="FormElement">Please verify you captcha</div>
                                <?php }?></td>
					          </tr>
						      <tr>
						        <td><input type="submit" name="Register" id="Register" value="Register" /> 
					            <input type="submit" name="Clear" id="Clear" value="Clear" /></td>
					          </tr>
						      <tr>
						        <td>&nbsp;</td>
					          </tr>
					        </table>
						    <input type="hidden" name="MM_insert" value="RegisterForm" />
					      </form>
						</div>
    </div>
</div>
<div id="Footer"></div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "email");
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2", {maxChars:16, minChars:8});
var sprypassword3 = new Spry.Widget.ValidationPassword("sprypassword3", {minChars:8, maxChars:16});
</script>
</body>
</html>
<?php
mysql_free_result($Register);
?>
