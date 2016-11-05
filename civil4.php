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
<table width="290" border="0" align="center" bgcolor="#FFCC33">
  <tr>
    <td><table height="450" width="374" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%2023%2C%20TINGKAT%201%20%20JALAN%20KAJANG%20IMPIAN%201%2F2%20%20TAMAN%20KAJANG%20IMPIAN%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="518" width="367" border="1" >
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
    <td><iframe width="600" height="520" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO%20705A%20(1ST%20FLOOR)%20COMPLEX%20DIAMOND%20%20BANGI%20BUSINESS%20PARK%20%20JALAN%20MEDAN%20BANGI%20OFF%20PERSIARAN%20BANDAR%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="450" width="372" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=27%20JALAN%204%2F10B%20%20SEKSYEN%204%20TAMBAHAN%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="584" width="370" border="1" >
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
    <td><iframe width="600" height="580" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=JALAN%20BG%203B%2F1%20%20BANGI%20GATEWAY%203B%2C%20%20OFF%20PERSIARAN%20WAWASAN%2C%20SEKSYEN%2015%2C%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="450" width="369" border="1" >
      <tr>
        <td width="109"><strong>Firm &nbsp;</strong></td>
        <td width="247">ADNAN RIDA &amp; ASSOCIATESSHA</td>
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
    <td><iframe width="600" height="520" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%203-2-2A%2C%20JALAN%20MEDAN%20PB%202A%20%20SEKSYEN%209%2C%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
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
