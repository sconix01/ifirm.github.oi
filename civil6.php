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
				<li><a href="civil.php">Civil</a></li>
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
</div>
<table width="290" border="1" align="center" bgcolor="#FFCC33">
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">F IDRIS &amp; ASSOCIATES</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO.17A, JALAN 6C/5 <br />
          BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>019-3300693</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89231994</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:f.idrisassociates@gmail.com"><strong>f.idrisassociates@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=F/295"><strong>FAIRUZ BINTI IDRIS</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">FARIZ HALIM &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>12A, JALAN 4/12B <br />
          SEKSYEN 4 TAMBAHAN <br />
          BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89122583</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89124583</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:hifdzico.hbb@gmail.com"><strong>hifdzico.hbb@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/2236"><strong>MAHFUZAH HANISAH BINTI  MOHD ARIFF</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/1388"><strong>MOHAMMAD HIFDZI BIN  HAMZAH</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=12A%2C%20JALAN%204%2F12B%20%20SEKSYEN%204%20TAMBAHAN%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">FAZLAN ALLAUDIN &amp;  IZASUHANA</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 7, JALAN 9/2 <br />
          TAMAN IKS SEKSYEN 9 <br />
          BANDAR BARU BANGI <br />
          46350 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89262217</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89262218</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:fazlan_co@yahoo.com"><strong>fazlan_co@yahoo.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=H/364"><strong>HAZIZAH BT KASSIM</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/3261"><strong>NURUL FATHIHAH BINTI  ZAINAL ABIDIN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=S/2878"><strong>SHAFINAH BINTI TAIB</strong></a><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/1809"></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2046350%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">ABDUL RAZAK MUHIDIN &amp;  ASSOCIATES</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO 2B, JALAN 3/69 <br />
          SEKSYEN 3 TAMBAHAN <br />
          BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89204380 ,  03-89204381/82</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89204378</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:abdulrazak.muidin@gmail.com"><strong>abdulrazak.muidin@gmail.com</strong></a><a href="mailto:fazlan_co@yahoo.com"></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=A/381"><strong>ABDUL RAZAK B MUHIDIN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/894"><strong>NINI SHIRMA BINTI  RAHMAT</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/2874"><strong>NURHUSNA BT SHAMSUDDIN</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO%202B%2C%20JALAN%203%2F69%20%20SEKSYEN%203%20TAMBAHAN%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
</table>
<h3 align="center" style="color:#F63"><a href="civil1.php">1</a><a href="civil2.php">2</a><a href="civil3.php">3</a><a href="civil4.php">4</a><a href="civil5.php">5</a><a href="civil6.php">6</a></h3>
<div id="Footer">

</div>
</div>
</body>
</html>
<?php
mysql_free_result($LogOut);

mysql_free_result($user);
?>
