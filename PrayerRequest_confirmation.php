<?php
## This is Bill Lenhard's Spam Proof Email Script
## Developed for Christian-Internet.com
## http://www.christian-internet.com
## mailto:qatest@christian-internet.com
## Spammers use the default form "enctype" which this script does not accept.
## This will generally limit form submittals to only live people browsing the website.
## form tag example:
## <form method="post" action="thisscript" enctype="multipart/form-data">
##

if (strpos($_SERVER["CONTENT_TYPE"], "multipart/form-data") !== false) {
	$todayis = date("l, F j, Y, g:i a");
	$subject = "TWBD - Prayer Request";
	$to = "TWBD@verizon.net";

## Capture submitted form fields.
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$contactpreference = $_POST['contactpreference'];
	$prayertype = $_POST['prayertype'];
	$comments = $_POST['comments'];

## Create email message body.
	$message = "Name: $name \n";
	$message .= "Email: $email \n";
	$message .= "Phone: $phone \n";
	$message .= "Contact Preference: $contactpreference \n";
	$message .= "Prayer Type: $prayertype \n";
	$message .= "Submitted: $todayis \n";
	$message .= "Comments: $comments \n";

## Strip out extra to:, bcc:, and cc: (spam injections).
	$strip = array("to:", "bcc:", "cc:");
	$subject = str_replace($strip, "", $subject);
	$message = str_replace($strip, "", $message);
	$email = str_replace($strip, "", $email);
	$name = str_replace($strip, "", $name);

## Set proper headers for Windows Sendmail.
	$headers = "From: ".$name." <".$email.">\n";
	ini_set("sendmail_from",$email);

## Add tracking details, so we know where this email came from (for troubleshooting purposes).
	$headers .= "x-email_generated_by: http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]."\n";
	$headers .= "x-form_submitted_from: ".$_SERVER["HTTP_REFERER"]."\n";

## Uncomment for testing or troubleshooting.
	$headers .= "bcc: qatest@christian-internet.com\n";

## Send the message.
	mail($to, $subject, $message, $headers);
	ini_restore("sendmail_from");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
	<title>Prayer Request Confirmation</title>
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
<h1>Prayer Request Confirmation</h1>
<p>Thank you for contacting Thy Will Be Done Ministries.  We will respond to you as soon as possible.</p>
		</div>
	</div>
	<div id="footer">
<?php include 'footer.php';?>
	</div>
</div>
</body>
</html>
