<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>registrate</title>
        </head>
        <body>
            <div>
                <form action="registrate.php" method="POST">
                    <p>Please enter your username and password to registrate!</p>
                    <label for="name">Name &mdash;</label>
                    <input type="text" name="username" id="name" />
                    <label for="password">Password &mdash;</label>
                    <input type="text" name="password" id="name" />
                    <input type="submit" name="enter" id="enter" value="Enter" />
                </form>
            </div>
        </body>
    </html>


<?php 

	// Author:			Jason Bozoki
	// Date:			07-07-2021
	// File:			registrate.php

	// Description:		Recieve data from registate.php to be able to log into the chat app

	include"../database/config.php";
	include("../database/opendb.php");
	include("../functions/functions.php");

	if(isset($_POST['username'])) {
		$username = $_POST['username'];
	} else {
		echo "Username niet opgegeven, probeer opniew. <br>";
	}

	if(isset($_POST['password'])) {
		$password = $_POST['password'];
	} else {
		echo "Wachtwoord niet opgegeven, probeer opniew. <br>";
	}
	


	// checks if everything has been filled out properly
	if($username=='' || $password=='') {
		echo '<script type="text/JavaScript">;
	     alert("Je moet alles invullen om iemand toe te voegen!");
	     </script>';
		exit;
	}

	$hashedPassword = encrypt($password);


	// takes the highest id of the workers table
	$query = "SELECT max(id) AS maxid ";
	$query .= "FROM users ";

	// prepares the query's and execute's them
	$preparedquery = $dbaselink->prepare($query);
	$preparedquery->execute();

	if ($preparedquery->errno) {
		echo "Fout bij uitvoeren commando";
		mysqli_rollback($dbaselink);
	} else {
		$result = $preparedquery->get_result();

		if ($result->num_rows === 0) {
			$maxid = 0;
		} else {
			$row = $result->fetch_assoc();
			$maxid = $row['maxid'];
		}
	}
	$preparedquery->close();

	$nextid = $maxid + 1;


	//insert it into the table and adds a new worker to the database
	$query = "INSERT INTO users(id, username, password) ";
	$query .= "VALUES (?,?,?)";

	//prepares the insert and executes it if dont properly
	$preparedquery = $dbaselink->prepare($query);
	$preparedquery->bind_param("isssss", $nextid, $username, $hashedPassword);
	$result = $preparedquery->execute();

	if (($result===false) || ($preparedquery->errno)) {
		echo "Oops, fout";
	}



	mysqli_commit($dbaselink);
	$preparedquery->close();

	include("../database/closedb.php");

	header("location: ../welcome.php");



?>