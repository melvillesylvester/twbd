<?php virtual('/Connections/twbd_db.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO twbd (messID, `date`, message, speaker, media) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['messID'], "text"),
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['message'], "text"),
                       GetSQLValueString($_POST['speaker'], "text"),
                       GetSQLValueString($_POST['media'], "text"));

  mysql_select_db($database_twbd_db, $twbd_db);
  $Result1 = mysql_query($insertSQL, $twbd_db) or die(mysql_error());

  $insertGoTo = "mm_update.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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
        <form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">
          <table align="center">
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">MessID:</td>
              <td><input type="text" name="messID" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Date:</td>
              <td><input type="text" name="date" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Message:</td>
              <td><input type="text" name="message" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Speaker:</td>
              <td><input type="text" name="speaker" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Media:</td>
              <td><input type="text" name="media" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">&nbsp;</td>
              <td><input type="submit" value="Insert record" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1" />
        </form>
        <p>&nbsp;</p>
        <table border="1" cellpadding="3" cellspacing="3">
          <tr>
            <td>messID</td>
            <td>date</td>
            <td>message</td>
            <td>speaker</td>
            <td>media</td>
            <td>&nbsp;</td>
          </tr>
          <?php do { ?>
            <tr>
              <td><?php echo $row_twbdRec['messID']; ?></td>
              <td><?php echo $row_twbdRec['date']; ?></td>
              <td><?php echo $row_twbdRec['message']; ?></td>
              <td><?php echo $row_twbdRec['speaker']; ?></td>
              <td><?php echo $row_twbdRec['media']; ?></td>
              <td>&nbsp;</td>
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
