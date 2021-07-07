<?php 

	// Author:			Jason Bozoki;
	// Date:			07-07-2021;
	// File:			login.php;

	// Description:		This file will login a person using the data;
	// 					from welcome.php;

	include("../database/config.php");
	include("../database/opendb.php");
	include("../functions/functions.php");


	session_start();

	if (isset($_POST['username'])) {
		$username = $_POST['username'];
	} else {
		echo "Username has not been given!";
	}

	if (isset($_POST['password'])) {
		$password = $_POST['password'];
	} else {
		echo "Password has not been given!";
	}

	$hashedPassword = encrypt($password);

	$query = "SELECT id, username, password ";
    $query .= "FROM users ";
    $query .= "WHERE username = ? AND password = ?";

	$preparedquery = $dbaselink->prepare($query);
	$preparedquery->bind_param("ss", $username, $hashedPassword);
	$result = $preparedquery->execute();
	if ($preparedquery->errno) {
		echo "Fout bij uitvoeren commando";
		mysqli_rollback($dbaselink);
	} else {
		$result = $preparedquery->get_result();

		if ($result->num_rows === 0) {
			$maxid = 0;
			echo $result->num_rows;
		} else {
			// $row = $result->fetch_assoc();
			// $id = $row['id'];
			// $email = $row['email'];
			// // $password = $row['password'];
			// $level = $row['level'];

			while($row = $result->fetch_assoc()) {
				// shows people the citizens in the database + their info
				echo "<tr>";
					echo "<th scope=\"row\"> id " . $row['id'] . "<br></th>";
					$id = $row['id'];
					echo "<td > Username " . $row['username'] . " </td>";
					$username = $row['username'];
				echo "</tr>";
			}
		}
	}



	$_SESSION['id'] = $row['id'];
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $hashedPassword;

    header("location:../index.html");


	mysqli_commit($dbaselink);
	$preparedquery->close();


	include("../database/closedb.php");
	// include("logout.php");

?>