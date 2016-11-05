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
</div>
<table width="290" border="1" align="center" bgcolor="#FFCC33">
  <tr>
    <td><table height="450" width="290" border="1"  >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">HAIRIL SHAM &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 25A, JALAN JERNANG JAYA  1 <br />
          TAMAN JERNANG JAYA <br />
          BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89280026</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89280023</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:hairilco@gmail.com"><strong>hairilco@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/1809"><strong>MOHD HAIRIL BIN  SULAIMAN</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%2025A%2C%20JALAN%20JERNANG%20JAYA%201%20%20TAMAN%20JERNANG%20JAYA%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="420" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">HAZIZAH &amp; CO</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>LOT 2.01 (OFF 4) <br />
          TINGKAT 2, KOMPLEKS PKNS BANGI <br />
          PERSIARAN BANGI, BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89261322 , 03-89262322</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89255322</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:hazzico@gmail.com"><strong>hazzico@gmail.com</strong></a><a href="mailto:hairilco@gmail.com"></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=H/364"><strong>HAZIZAH BT KASSIM</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/3261"><strong>NURUL FATHIHAH BINTI  ZAINAL ABIDIN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=S/2878"><strong>SHAFINAH BINTI TAIB</strong></a><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/1809"></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="520" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=JALAN%209%2F9C%20%20SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="450" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">JUNITA IBRAHIM &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 11A-1, JALAN 9/9C <br />
          SEKSYEN 9 <br />
          BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89280615</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89280615</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:junitaibrahimco@gmail.com"><strong>junitaibrahimco@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=J/280"><strong>JUNITA BINTI IBRAHIM</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=JALAN%209%2F9C%20%20SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="450" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">M.K. OTHMAN &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>SUITE 37-1, JALAN 9/9C <br />
          SEKSYEN 9 <br />
          BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89275064 , 019-2347270</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89125946</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:mk_othman_co@yahoo.com"><strong>mk_othman_co@yahoo.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/1164"><strong>MOHD KHAIRUDDIN BIN  OTHMAN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=O/275"><strong>OTHMAN BIN MOHD NOOR</strong></a><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/1809"></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=%20JALAN%209%2F9C%20%20SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="450" width="340" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">MUIZ SAMSURI &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO.6-2-1,TINGKAT 2 <br />
          JALAN MEDAN PUSAT BANDAR 4A <br />
          SEKSYEN 9,BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89202624</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89202675</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:muiz_samsuri@yahoo.com"><strong>muiz_samsuri@yahoo.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=A/875"><strong>ABD MUIZ BIN SAMSURI</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/851"><strong>MOHAMAD SALLEH BIN AZIZ</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=S/2162"><strong>SYAHIRAH BINTI ZAINOL  ALAM</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=%20JALAN%209%2F9C%20%20SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
</table>
<h3 align="center" style="color:#F63"><a href="civil1.php">1&nbsp;</a><a href="civil2.php">2&nbsp;</a><a href="civil3.php">3&nbsp;</a><a href="civil4.php">4&nbsp;</a><a href="civil5.php">5&nbsp;</a></h3>
</br>
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
