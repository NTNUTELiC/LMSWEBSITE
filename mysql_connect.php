<?php
$host="localhost";
$user="root";
$password="";
$link=mysql_connect($host,$user,$password);
$query = "SET NAMES 'utf8'";
$result = mysql_query($query);
mysql_select_db("LMS",$link) || die("db error");
?>