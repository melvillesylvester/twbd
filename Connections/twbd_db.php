<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_twbd_db = "localhost";
$database_twbd_db = "twbd";
$username_twbd_db = "twbd";
$password_twbd_db = "mech1234";
$twbd_db = mysql_pconnect($hostname_twbd_db, $username_twbd_db, $password_twbd_db) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
