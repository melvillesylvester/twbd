<?php virtual('Connections/twbd_db.php'); ?>
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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_twbd_db, $twbd_db);
$query_Recordset1 = "SELECT twbd.`Date`, twbd.Message, twbd.Speaker, twbd.Media FROM twbd";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $twbd_db) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
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

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_changeProp(objId,x,theProp,theValue) { //v9.0
  var obj = null; with (document){ if (getElementById)
  obj = getElementById(objId); }
  if (obj){
    if (theValue == true || theValue == false)
      eval("obj.style."+theProp+"="+theValue);
    else eval("obj.style."+theProp+"='"+theValue+"'");
  }
}

</script>
</head>
<body onload="MM_preloadImages('/images/template/twbd_home_MM_down.jpg')">
<div id="page" class="clear clearfix">
  <div id="header">
    <?php include 'header.php';?>
  </div>
  <div id="buttons">
    <?php include 'buttons.php';?>
  </div>
  <div id="main_body">
    <div id="content" class="clear clearfix">
      <div id="ministry_media"><img src="/images/twbd_mministry_pastor.jpg" width="105" height="152" style="padding-right:12px; float:left;" onload="MM_swapImage('mmediaup','','/images/template/twbd_home_MM_down.jpg',1)" />
        <h1 >Be blessed by God's Word</h1>
        <p >Psalm 19:7 reveals that &quot; the law of the Lord is perfect, restoring the [whole] person; the testimony of the Lord is sure, making wise the simple.&quot;  When the Word of God is preached and received into the heart by simple faith, miraculous changes happen.  Faith is produced by God's Word as the hearer does what the Word commands.  I encourage you to listen to the following messages with a receptive heart and apply the concepts to your life.  Then watch and see how the supernatural power of God's Word restores you--spirit, soul and body.</p>
      </div>
      <div class="media">
        <table width="100%" border="0" cellpadding="3" cellspacing="3">
          <tr>
            <td><h3>Date</h3></td>
            <td><h3>Message</h3></td>
            <td><h3>Speaker</h3></td>
            <td width="225"><h3>Media</h3></td>
          </tr>
          <?php $i = 0; $player = ""; do { $i++; $player+=$i; ?>
            <tr>
              <td><?php echo $row_Recordset1['Date']; ?></td>
              <td><h4><?php echo $row_Recordset1['Message']; ?></h4></td>
              <td><?php echo $row_Recordset1['Speaker']; ?></td>
              <td valign="middle"><!--MEDIA PLAYER SCRIPT-->
            <div  style="width:225px;"> 
                <script type='text/javascript' src='media/jwplayer.js'></script>
                <h2><a href="javascript:void(0)" onclick="MM_changeProp('<?php echo "$player"; ?>','','display','inline','DIV')"><img src="/images/template/twbd_icon_download.jpg" alt="Right click and save as" width="26" height="24" align="absmiddle" />FLASH</a> | <a href="/media/<?php echo $row_Recordset1['Media']; ?>">MP3</a></h2>
                <div id="<?php echo "$player"; ?>" style="display:none">
                  <div style="float:right; width:20px;" ><a href="javascript:void(0)" onclick="MM_changeProp('<?php echo "$player"; ?>','','display','none','DIV')"><img src="images/template/closeIcon.png" width="21" height="21" alt="close player" /></a> </div>
                  <div id='mediaspace<?php echo "$i" ?>' style="background-color:#FF0" >FlashPlayer Needed</div>
                </div>
              </div>
              <script type='text/javascript'>
                  jwplayer('mediaspace<?php echo "$i" ?>').setup({
                    'flashplayer': 'player.swf',
                    'author': '<?php echo $row_Recordset1['Speaker']; ?>',
                    'description': '<?php echo $row_Recordset1['Message']; ?>',
                    'file': '/media/<?php echo $row_Recordset1['Media']; ?>',
                    'provider': 'TWBD Christian Ministries',
                    'backcolor': '64002d',
                    'frontcolor': 'FFFFFF',
                    'controlbar': 'bottom',
                    'width': '200',
                    'height': '20'
                  });
                </script>
            <!--MEDIA PLAYER SCRIPT END-->
              </td>
            </tr>
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        </table>
        </div>
    </div>
  </div>
  <div id="footer">
    <?php include 'footer.php';?>
  </div>
</div>

<script type="text/javascript">
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
