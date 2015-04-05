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
      
      <form ACTION="mm_edit.php" id="form1" name="form1" method="POST">
  <p>Username&nbsp;
    <input type="text" name="uname" id="uname" />
    <br />
    <br />
    Password&nbsp;
    <input type="password" name="passw" id="passw" />
  </p>
  
	  <?php 
	  //static $tryouts=0; 
      if (isset($_GET['tryouts'])&&($_GET['tryouts']==1)){
      echo "<p>Please check your login information and try again</p>";
	  }else{$tryouts = 1;}
	  ?>
      
  <p>
    <input type="submit" name="submit" id="submit" value="Submit" />
  </p>
</form>
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