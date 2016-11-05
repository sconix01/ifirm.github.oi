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
    <td><table height="450" width="390" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=33A-2-2A%2C%20JALAN%20MEDAN%20PB%202B%20%20SEKSYEN%209%2C%20PUSAT%20BANDAR%20BANGI%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="449" width="391" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%2020%2C%203%2F72%2C%20TAMAN%20DAMAI%20IMPIAN%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="450" width="290" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=LEVEL%202%20%20JALAN%20MEDAN%20PUSAT%20BANDAR%204A%2C%20SEKSYEN%209%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="450" width="390" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%205-1%2C%20LEVEL%201%20%20JALAN%207%2F7A%2C%20SEKSYEN%207%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
  </tr>
  <tr>
    <td><table height="450" width="390" border="1" >
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
    <td><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q=NO.%2014-1A%2C%20JALAN%2015%2F1F%20%20SEKSYEN%2015%20%20BANDAR%20BARU%20BANGI%20%2043650%20BANGI&amp;key=AIzaSyDbYfVEMKgdpMx0npQDldOSgLLk3Tdj5AU" allowfullscreen="allowfullscreen"></iframe></td>
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
