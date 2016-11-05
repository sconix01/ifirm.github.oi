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
    <td><table height="450" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">AHMAD FUAD AMIN &amp;  PARTNERS</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO.18, 2ND FLOOR <br />
          MEDAN PB1, SECTION 9 <br />
          BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89253588 , 03-89257187</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89255832</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:afap1213@gmail.com"><strong>afap1213@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=A/562"><strong>ADZHALIZA BT MOHD NOR</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/2406"><strong>NOOR SHAZWANI BINTI  KHAMIN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=R/408"><strong>RAZALI BIN MD NOR</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.18%2C%202ND%20FLOOR%20%20MEDAN%20PB1%2C%20SECTION%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">AMIRUL &amp; NAJIB</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 1, 4TH FLOOR, JALAN  MEDAN PUSAT 2D <br />
          3B, CURVE BUSINESS PARK <br />
          PERSIARAN BANGI, SEKSYEN 9 <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89254385</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89258385</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:najibassociates@gmail.com"><strong>najibassociates@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=H/524"><strong>HUSNI BIN ABDUL MANAN</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=JALAN%20MEDAN%20PUSAT%202D%20%203B%2C%20CURVE%20BUSINESS%20PARK%20%20PERSIARAN%20BANGI%2C%20SEKSYEN%209%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">ASIAH &amp; HISAM</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO.2-21, JALAN 8/35, <br />
          SERI BANGI , SEKSYEN 8 <br />
          BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89124455 , 03-89124466</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89124477</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:ahsentral@gmail.com"><strong>ahsentral@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=A/1923"><strong>AHMAD ZIADI BIN ZAIDON</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/2164"><strong>MOHD ZAKWAN BIN ADENAN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/2522"><strong>NORAZIDAH BTE ABDUL  MUES</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/2332"><strong>NUR SYAZWANI BINTI  RAMLEE</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.2-21%2C%20JALAN%208%2F35%2C%20%20SERI%20BANGI%20%2C%20SEKSYEN%208%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">AZMI ZURAINI &amp;  ASSOCIATES</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO.20B, JALAN 3/69 <br />
          SEKSYEN 3 TAMBAHAN <br />
          BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89209365</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-56333118</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:azmizuraini@gmail.com"><strong>azmizuraini@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/589"><strong>NOR AZMI BIN ABU TALIB</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.20B%2C%20JALAN%203%2F69%20%20SEKSYEN%203%20TAMBAHAN%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
   <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">ELIDA IMRAN &amp; PARTNERS</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>18-G-01, JALAN MEDAN PB 2A <br />
          SEKSYEN 9 <br />
          BANDAR BARU BANGI <br />
          43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89255353 , 03-89202797 /  89202728 / 89202817</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89127353</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:elidaimran@yahoo.com"><strong>elidaimran@yahoo.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=A/2184"><strong>AHMAD HAFIZ BIN A.  BAKAR</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=E/15"><strong>ELIDA BT KAMALUDDIN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/400"><strong>MISMARNI BT ABU MANSOR</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/1905"><strong>NUR AINI SYAFAWATY  BINTI ROSLAN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=R/373"><strong>RODZIM ZAIMY BIN ABDUL  HAMID</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.20B%2C%20JALAN%203%2F69%20%20SEKSYEN%203%20TAMBAHAN%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
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
