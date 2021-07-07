<?php
//    session_start();
//    unset($_SESSION["id"]);
//    unset($_SESSION["username"]);
//    unset($_SESSION["password"]);

   if(isset($_GET['logout'])){ 
     
    //Simple exit message
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat session.</span><br></div>";
    file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
     
    session_destroy();
    header("Location: ../welcome.php"); //Redirect the user
}
   
   // echo 'You have cleaned session';
//    header('Refresh: 3600; URL = welcome.php');
//    header('location: ../welcome.php');
?>