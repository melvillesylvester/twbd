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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE twbd SET `Date`=%s, Message=%s, Speaker=%s, Media=%s WHERE MessID=%s",
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['Message'], "text"),
                       GetSQLValueString($_POST['Speaker'], "text"),
                       GetSQLValueString($_POST['Media'], "text"),
                       GetSQLValueString($_POST['MessID'], "text"));

  mysql_select_db($database_twbd_db, $twbd_db);
  $Result1 = mysql_query($updateSQL, $twbd_db) or die(mysql_error());
}
$mySearch = $_POST['my_Search'];
mysql_select_db($database_twbd_db, $twbd_db);
$query_updateRec = "SELECT twbd.MessID, twbd.`Date`, twbd.Message, twbd.Speaker, twbd.Media FROM twbd WHERE twbd.MessID ='$mySearch'";
$updateRec = mysql_query($query_updateRec, $twbd_db) or die(mysql_error());
$row_updateRec = mysql_fetch_assoc($updateRec);
$totalRows_updateRec = mysql_num_rows($updateRec);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <p>Find Record:
    <input type="text" name="my_Search" id="my_Search" />
  </p>
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">MessID:</td>
      <td><?php echo $row_updateRec['MessID']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Date:</td>
      <td><input type="text" name="Date" value="<?php echo htmlentities($row_updateRec['Date'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Message:</td>
      <td><input type="text" name="Message" value="<?php echo htmlentities($row_updateRec['Message'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Speaker:</td>
      <td><input type="text" name="Speaker" value="<?php echo htmlentities($row_updateRec['Speaker'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Media:</td>
      <td><input type="text" name="Media" value="<?php echo htmlentities($row_updateRec['Media'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="MessID" value="<?php echo $row_updateRec['MessID']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($updateRec);
?>
