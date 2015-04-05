<?php
 include 'Connections/editlist.php';
 
 if(($_POST['uname'] === $uname_login) && ($_POST['passw'] === $passw_login))
	{	
	// continue
	}
	else 
	{	
		header('Location: '.$return);
	}

 include_once('Connections/twbd_db.php'); 
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formupdate")) {
  $updateSQL = sprintf("UPDATE twbd SET `Date`=%s, Message=%s, Speaker=%s, Media=%s WHERE MessID=%s",
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['Message'], "text"),
                       GetSQLValueString($_POST['Speaker'], "text"),
                       GetSQLValueString($_POST['Media'], "text"),
                       GetSQLValueString($_POST['MessID'], "int"));

  mysql_select_db($database_twbd_db, $twbd_db);
  $Result1 = mysql_query($updateSQL, $twbd_db) or die(mysql_error());
  $send = 1;
  $updateGoTo = "mm_edit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
	}
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO twbd (`Date`, Message, Speaker, Media) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['Message'], "text"),
                       GetSQLValueString($_POST['Speaker'], "text"),
                       GetSQLValueString($_POST['Media'], "text"));

  mysql_select_db($database_twbd_db, $twbd_db);
  $Result1 = mysql_query($insertSQL, $twbd_db) or die(mysql_error());

  $insertGoTo = "mm_edit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $insertGoTo));
}

if (isset($_POST['delRec']) && ($_POST['delRec'] != "")) { //(isset($_POST['MessID'])) && 
	echo "This works";
  $deleteSQL = sprintf("DELETE FROM twbd WHERE MessID=%s",
                       GetSQLValueString($_POST['delRec'], "text"));

  mysql_select_db($database_twbd_db, $twbd_db);
  $Result1 = mysql_query($deleteSQL, $twbd_db) or die(mysql_error());

  $deleteGoTo = "mm_edit.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $deleteGoTo));
}

$maxRows_twbdRec = 20;
$pageNum_twbdRec = 0;
if (isset($_GET['pageNum_twbdRec'])) {
  $pageNum_twbdRec = $_GET['pageNum_twbdRec'];
}
$startRow_twbdRec = $pageNum_twbdRec * $maxRows_twbdRec;

mysql_select_db($database_twbd_db, $twbd_db);
$query_twbdRec = "SELECT messID, `date`, message, speaker, media FROM twbd ORDER BY `date` ASC";
$query_limit_twbdRec = sprintf("%s LIMIT %d, %d", $query_twbdRec, $startRow_twbdRec, $maxRows_twbdRec);
$twbdRec = mysql_query($query_limit_twbdRec, $twbd_db) or die(mysql_error());
$row_twbdRec = mysql_fetch_assoc($twbdRec);

if (isset($_GET['totalRows_twbdRec'])) {
  $totalRows_twbdRec = $_GET['totalRows_twbdRec'];
} else {
  $all_twbdRec = mysql_query($query_twbdRec);
  $totalRows_twbdRec = mysql_num_rows($all_twbdRec);
}
$totalPages_twbdRec = ceil($totalRows_twbdRec/$maxRows_twbdRec)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<title>Services</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META NAME="keywords" content="">
<META NAME="description" content="">
<META NAME="Author" CONTENT="http://www.christian-internet.com">
<META NAME="MSSmartTagsPreventParsing" CONTENT="TRUE">
<META NAME="REVISIT-AFTER" CONTENT="7 days">
<META NAME="LANGUAGE" CONTENT="EN">
<META NAME="robots" content="follow all">
<LINK REV="made" HREF="http://www.christian-internet.com">
<META NAME="distribution" CONTENT="Global">
<META NAME="rating" CONTENT="General">
<link rel="stylesheet" type="text/css" href="/stylesheet.css">
<?php include 'dropdown.php';?>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>

<script type="text/javascript">
function submitform(){
confirm("This record will be deleted!")
{document.form3.submit();};
}
</script>

</head>
<body>
<div id="page" class="clear clearfix">
  <div id="header">
    <?php include 'header.php';?>
  </div>
  <div id="buttons">
    <?php include 'buttons.php';?>
  </div>
  <div id="main_body">
    <div id="content" class="clear clearfix">
      <div class="media">
        <p>&nbsp;</p>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
          <table align="center">
            <tr valign="baseline">
              <td align="right">Date:</td>
              <td><input type="text" name="Date" value="YYYY-MM-DD" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td align="right">Message:</td>
              <td><input type="text" name="Message" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td align="right">Speaker:</td>
              <td><input type="text" name="Speaker" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td align="right">Media:</td>
              <td><input type="text" name="Media" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td align="right">&nbsp;</td>
              <td><input type="submit" value="Insert NEW record" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1" />
          <input type="hidden" name="uname" value="<?php echo $uname_login; ?>" />
          <input type="hidden" name="passw" value="<?php echo $passw_login; ?>" />
          
        </form>
        <p>&nbsp;</p>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>messID</td>
            <td>date</td>
            <td><strong>message</strong></td>
            <td>speaker</td>
            <td>media</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <?php do { ?>
            <tr>
              <td><?php echo $row_twbdRec['messID']; ?></td>
              <td><?php echo $row_twbdRec['date']; ?></td>
              <td><strong><?php echo $row_twbdRec['message']; ?></strong></td>
              <td><?php echo $row_twbdRec['speaker']; ?></td>
              <td><?php echo $row_twbdRec['media']; ?></td>
              <td><form id="form2" name="form2" method="post" action="mm_update.php">
                <input name="updateRec" type="hidden" id="updateRec" value="<?php echo $row_twbdRec['messID']; ?>" />
                <input type="submit" name="update" id="update" value="edit" />
              </form></td>
              <td><form id="form3" name="form3" method="post" action="mm_edit.php">
                <input type="hidden" name="delRec" id="delRec" value="<?php echo $row_twbdRec['messID'] ?>" />                
                <input type="submit" name="delete" id="delete" value="delete" />
              </form></td>
            </tr>
            <?php } while ($row_twbdRec = mysql_fetch_assoc($twbdRec)); ?>
        </table>
      </div>
    </div>
  </div>
  <div id="footer">
    <?php include 'footer.php';?>
  </div>
</div>
<p>&nbsp;</p>
<script type="text/javascript">
</script>
</body>
</html>
<?php
mysql_free_result($twbdRec);
?>
