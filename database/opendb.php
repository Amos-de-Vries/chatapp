<?php
// CREATED BY: SANDER, AMOS, JASON
// 07/07/2021
// HACKATON

$dbaselink = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
	or die("Niet mogelijk omverbinding te maken met de dbase server" . mysqli_connect_error());

set_time_limit(60); // 60 seconds

?>