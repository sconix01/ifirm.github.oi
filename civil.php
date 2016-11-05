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
<table width="400" border="1" align="center" bgcolor="#FFCC33" >
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
  <tr>
    
    
  </tr>
</table>
</td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%2025A%2C%20JALAN%20JERNANG%20JAYA%201%20%20TAMAN%20JERNANG%20JAYA%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="450" width="290" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=KOMPLEKS%20PKNS%20BANGI%20%20PERSIARAN%20BANGI%2C%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=JALAN%209%2F9C%20%20SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe>
</td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=%20JALAN%209%2F9C%20%20SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=%20JALAN%209%2F9C%20%20SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">NUR SHAREEFAH &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 5, JALAN IMPIAN PUTRA  4/4 <br />
TAMAN IMPIAN PUTRA <br />
43000 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89253910</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89253909</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:nur_shareefah@shanco.com.my"><strong>nur_shareefah@shanco.com.my</strong></a><a href="mailto:hazzico@gmail.com"></a><a href="mailto:hairilco@gmail.com"></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/1159"><strong>NUR SHAREEFAH LUSIA  BINTI ABDULLAH</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.6-2-1%2CTINGKAT%202%20%20JALAN%20MEDAN%20PUSAT%20BANDAR%204A%20%20SEKSYEN%209%2CBANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">RAHMAH &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>BILIK UTAMA, 14-1A JALAN  15/1F, SECTION 15 <br />
BANDAR BARU BANGI <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89223055 , 03-89223018</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89223018</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:rahmahco@gmail.com"><strong>rahmahco@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=R/366"><strong>RAHMAH BT OTHMAN</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%205%2C%20JALAN%20IMPIAN%20PUTRA%204%2F4%20%20TAMAN%20IMPIAN%20PUTRA%20%2043000%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">RAMIZAH RAHIM &amp; CO</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 2 - 11, , JALAN 8/35,  SERI BANGI , SEKSYEN 8 <br />
BANDAR BARU BANGI <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89200117 , 013-2851011</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89220137</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:ramizahrahimco@gmail.com"><strong>ramizahrahimco@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=R/657"><strong>RAMIZAH BINTI ABD RAHIM</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=BILIK%20UTAMA%2C%2014-1A%20JALAN%2015%2F1F%2C%20SECTION%2015%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">RATHUAN &amp; ASSOCIATES</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO.8-07-03-B04, <br />
JALAN MEDAN 7A , BANGI SENTRAL <br />
SEKSYEN 9 <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89220220</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89220694</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:rathuanasc@gmail.com"><strong>rathuanasc@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=A/730"><strong>AINI DAHLIA BINTI  RATHUAN @ RADZUAN</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%202%20-%2011%2C%20%2C%20JALAN%208%2F35%2C%20SERI%20BANGI%20%2C%20SEKSYEN%208%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">RAZAK SHAHRIL &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>33A-2-2A, JALAN MEDAN PB 2B <br />
SEKSYEN 9, PUSAT BANDAR BANGI <br />
BANDAR BARU BANGI <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89274001/2</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89274008</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:razakshahril.co@gmail.com"><strong>razakshahril.co@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=A/972"><strong>ABDUL RAZAK BIN AHMAD  SHAHRIL</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=H/501"><strong>HERDAWATY BINTI ABU  OTHMAN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/3122"><strong>NAWAL FAKHRINA BINTI  AHMAD ZAWAWI</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=no%208%20Jalan%20Medan%20Pusat%20Bandar%207A%20Seksyen%209%20Bandar%20Baru%20Bangi%20Selangor%20Malaysia&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">TEE BEE LING &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 20, 3/72, TAMAN DAMAI  IMPIAN <br />
BANDAR BARU BANGI <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>014-9303258</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-21784187</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:teebl87@gmail.com"><strong>teebl87@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=T/1512"><strong>TEE BEE LING</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=33A-2-2A%2C%20JALAN%20MEDAN%20PB%202B%20%20SEKSYEN%209%2C%20PUSAT%20BANDAR%20BANGI%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">THE CHAMBERS OF ARIK AND  KAMAL</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 6-2-1 (SUITE B), LEVEL  2 <br />
JALAN MEDAN PUSAT BANDAR 4A, SEKSYEN 9 <br />
BANDAR BARU BANGI <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89261002 , 019-2267782</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89271002</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:main@arikandkamal.com"><strong>main@arikandkamal.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=A/1797"><strong>ARIK ZAKRI BIN ABDUL  KADIR</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%2020%2C%203%2F72%2C%20TAMAN%20DAMAI%20IMPIAN%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">WAN JUHRAH &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 5-1, LEVEL 1 <br />
JALAN 7/7A, SEKSYEN 7 <br />
BANDAR BARU BANGI <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-82116948 , 03-20355940</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89266096</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:enquiries@wanjuhrahlaw.com.my"><strong>enquiries@wanjuhrahlaw.com.my</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=W/612"><strong>WAN JUHRAH BINTI MUNTEK</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=LEVEL%202%20%20JALAN%20MEDAN%20PUSAT%20BANDAR%204A%2C%20SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">ZALILA &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 14-1A, JALAN 15/1F <br />
SEKSYEN 15 <br />
BANDAR BARU BANGI <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89202067</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89271055</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:zalilaco@gmail.com"><strong>zalilaco@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=Z/363"><strong>ZALILA BINTI MOKHLI</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%205-1%2C%20LEVEL%201%20%20JALAN%207%2F7A%2C%20SEKSYEN%207%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">ZURI &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 23, TINGKAT 1 <br />
JALAN KAJANG IMPIAN 1/2 <br />
TAMAN KAJANG IMPIAN <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89251699 , 03-89251594</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89251553</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:zurico2003@yahoo.co.uk"><strong>zurico2003@yahoo.co.uk</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=L/2065"><strong>LAILA AZHAN BINTI AHMAD  TAJUDDIN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/2716"><strong>MAZNEE BINTI MOHD JAMIL</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=Z/62"><strong>ZURI ZABUDDIN B BUDIMAN</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%2014-1A%2C%20JALAN%2015%2F1F%20%20SEKSYEN%2015%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">AIDAH MUSTAFFA &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO 705A (1ST FLOOR) COMPLEX  DIAMOND <br />
BANGI BUSINESS PARK <br />
JALAN MEDAN BANGI OFF PERSIARAN BANDAR <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-82104254 , 03-82101127</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-03-82104843</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:aidahmustaffa_co@yahoo.com"><strong>aidahmustaffa_co@yahoo.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=A/214"><strong>AIDAH AHMAD MUSTAFFA</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=E/171"><strong>ERNYBAYZURY BINTI ABDUL  BAHRIN</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%2023%2C%20TINGKAT%201%20%20JALAN%20KAJANG%20IMPIAN%201%2F2%20%20TAMAN%20KAJANG%20IMPIAN%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO%20705A%20(1ST%20FLOOR)%20COMPLEX%20DIAMOND%20%20BANGI%20BUSINESS%20PARK%20%20JALAN%20MEDAN%20BANGI%20OFF%20PERSIARAN%20BANDAR%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">ENGKU AMINUDDIN &amp; CO</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>27 JALAN 4/10B <br />
SEKSYEN 4 TAMBAHAN <br />
BANDAR BARU BANGI <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>012-6167538</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:engkuaminuddin@gmail.com"><strong>engkuaminuddin@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=E/53"><strong>ENGKU AMINUDDIN BIN  ENGKU IBRAHIM</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=27%20JALAN%204%2F10B%20%20SEKSYEN%204%20TAMBAHAN%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">ANI &amp; CO.</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO.E-1-1, JALAN BG 3B/1 <br />
BANGI GATEWAY 3B, <br />
OFF PERSIARAN WAWASAN, SEKSYEN 15, BANDAR BARU BANGI <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>019-6668431 , 019-6668413</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89125118</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:aga@ghanico.com.my"><strong>aga@ghanico.com.my</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=M/2281"><strong>MUHAMMAD HAFIIZH BIN  MUKHTARUDDIN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/284"><strong>NOR AZIAN BINTI MOHD NORDIN</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=R/268"><strong>ROHAYA BT MUSTAPA</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=JALAN%20BG%203B%2F1%20%20BANGI%20GATEWAY%203B%2C%20%20OFF%20PERSIARAN%20WAWASAN%2C%20SEKSYEN%2015%2C%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
      <tr>
        <td width="73"><strong>Firm &nbsp;</strong></td>
        <td width="201">ADNAN RIDA &amp; ASSOCIATESSHA</td>
      </tr>
      <tr>
        <td><strong>Branch &nbsp;</strong></td>
        <td>Bangi</td>
      </tr>
      <tr>
        <td><strong>Address</strong></td>
        <td>NO. 3-2-2A, JALAN MEDAN PB  2A <br />
SEKSYEN 9, BANDAR BARU BANGI <br />
43650 BANGI</td>
      </tr>
      <tr>
        <td><strong>Tel </strong></td>
        <td>03-89257558</td>
      </tr>
      <tr>
        <td><strong>Fax</strong></td>
        <td>03-89257560</td>
      </tr>
      <tr>
        <td><strong>E-mail &nbsp;</strong></td>
        <td><a href="mailto:adnansharida@gmail.com"><strong>adnansharida@gmail.com</strong></a></td>
      </tr>
      <tr>
        <td><strong>Member Lawyer(s) &nbsp;</strong></td>
        <td><a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=A/1146"><strong>ADNAN BIN SEMAN @  ABDULLAH</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=A/1806"><strong>AHMAD HAFIZ BIN ZUBIR</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=I/285"><strong>IZYAN ANIS BTE MUSANIF</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=N/1523"><strong>NASRUL HADI BIN MAT  SAAD</strong></a><br />
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=S/1726"><strong>SHARIDA BINTI ABD  RAHAMAN</strong></a></td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%203-2-2A%2C%20JALAN%20MEDAN%20PB%202A%20%20SEKSYEN%209%2C%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
  <tr>
    <td><table height="" width="290" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.18%2C%202ND%20FLOOR%20%20MEDAN%20PB1%2C%20SECTION%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=JALAN%20MEDAN%20PUSAT%202D%20%203B%2C%20CURVE%20BUSINESS%20PARK%20%20PERSIARAN%20BANGI%2C%20SEKSYEN%209%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.2-21%2C%20JALAN%208%2F35%2C%20%20SERI%20BANGI%20%2C%20SEKSYEN%208%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.20B%2C%20JALAN%203%2F69%20%20SEKSYEN%203%20TAMBAHAN%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
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
          <a href="http://www.malaysianbar.org.my/legaldirectory/mlawyerdetail.php?lid=R/373"><strong>RODZIM ZAIMY BIN ABDUL  HAMID</strong></a> </td>
      </tr>
      <tr></tr>
    </table></td>
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=18-G-01%2C%20JALAN%20MEDAN%20PB%202A%20%20SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
  </tr>
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=12A%2C%20JALAN%204%2F12B%20%20SEKSYEN%204%20TAMBAHAN%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2046350%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
    
  </tr>
  <tr>
  <td>
    <table height="" width="290" border="1" >
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
    </table></td><td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO%202B%2C%20JALAN%203%2F69%20%20SEKSYEN%203%20TAMBAHAN%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen></iframe></td>
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
