<!DOCTYPE html>
<!--
CREATED BY: SANDER, AMOS, JASON
07/07/2021
HACKATON
-->

<html>
<head>
<title>Chat List</title>
</head>

<body>

<?php

// CREATED BY: SANDER, AMOS, JASON
// 07/07/2021
// HACKATON

//includes the files needed to make a connection with the database.
include("database/config.php");
include("database/opendb.php");

// creates a select query who will select the id, name and password from the table chats (and orders it by id)
$query = "SELECT id, name, password ";
$query .= "FROM chats ";
$query .= "ORDER BY id ";

// prepares the given query above, once prepares it executes
$preparedquery = $dbaselink->prepare($query);
$preparedquery->execute();

// gives an error message upon a query error
if ($preparedquery->errno) {
	echo "Fout bij het uitvoeren van commando.";
} else {
	// puts the information given back from the select statement into the result variable, wich will then check how many rows there are.
	$result = $preparedquery->get_result();
	if ($result->num_rows===0) {
		echo "Er zijn geen broden";
	} else {
		// if there are any rows it will displace these within a table, with table headers and table data/rows.
		//opens the table
		echo "<table>";
			echo "<tr>";
	   		 echo "<th>ID</th>";
	   		 echo "<th>Naam</th>";
	   		 echo "<th>Wachtwoord</th>";
	  		echo "</tr>";

		while($row = $result->fetch_assoc()) {
			// puts the right data in the table data cells.
	 		echo "<tr>";
	   		 echo "<td>" . $row['id'] . "</td>";
	   		 echo "<td>" . $row['name'] . "</td>";
	   		 echo "<td>" . $row['password'] . "</td>";
	  		echo "</tr>";

		};
		// closes the table
		echo "</table>";
		// gives the amount of rows given back from the query (amount of bread)
		echo "<br><br>Totaal zijn er " . $result->num_rows . " Broden.";
	}
}
// closes the prepared query
$preparedquery->close();


// includes / executes a file that closes the database.
include("database/closedb.php");


?>

</body>
</html>