<?php

 session_start();

?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>welcome</title>
        </head>
        <body>
            <div>
                <h1>Login</h1>

                <form action="login/login.php" method = "POST" >
                    <input type="text" id="username" placeholder="username" name="username" required/>
                    <input type="text" name="password" id="password" placeholder="password" required/>
                    <button type="submit">login</button>
                </form>
            </div>
        </body>
    </html>