<?php 

	include("database/salt.php");

	function encrypt($pass) {
		$salted = SALTHEADER . $pass . SALTTRAILER;
		return hash('ripemd160', $salted);
		echo $salted;
	}

?>