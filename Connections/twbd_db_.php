<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_twbd_db = "twbdmain.db.7128844.hostedresource.com";
$database_twbd_db = "twbdmain";
$username_twbd_db = "twbdmain";
$password_twbd_db = "Pro123cess!";
$twbd_db = mysql_pconnect($hostname_twbd_db, $username_twbd_db, $password_twbd_db) or trigger_error(mysql_error(),E_USER_ERROR); 
?>