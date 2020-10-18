<?php

//connecting to the database
$error = "Could not connect to the database";
$con = mysql_connect('localhost','root','---') or die($error);
mysql_select_db("easydrive", $con) or die($error);

?>