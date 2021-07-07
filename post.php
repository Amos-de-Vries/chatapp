<?php
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
     
    $text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
}
?>



<?php
    include('../database/config.php');
    include('../database/opendb.php');
    include('../functions/functions.php');

    session_start();

    if(isset($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        echo "Username has not been given, this is required";
    }

    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        echo "Username has not been given, this is required";
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
			while($row = $result->fetch_assoc()) {
				$text = $_POST['text'];
     
                $text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['username']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
                file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
			}
		}
	}

?>