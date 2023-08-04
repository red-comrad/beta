<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            require_once("database.php");
            if(is_conn_alive())
            {
                session_start();
                $username = $_POST["username"];
                $password = $_POST["password"];
                $password = md5($password);
                mysqli_select_db($conn, "php_assignment");
                $query = "select * from users where username='" . $username . "' and password='" . $password . "' limit 1;";
                $ret = mysqli_query($conn, $query);
                if($ret->num_rows > 0)
                {
                    $row = $ret->fetch_assoc();
                    $_SESSION["username"] = $row["full_name"];
                    $_SESSION["first_login"] = $_SERVER["REQUEST_TIME"];
                    header("Location: index.php");
                }
                else
                {
                    $_SESSION = [];
                    session_destroy();
                    header("Location: login.php");
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,400;1,100&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="container__header">
            <img src="resource/logo.png" alt=""><span class="font--massive">DEV COMMUNITY</span>
        </div>
        <div class="container__body">
            <form action="login.php" method="POST">
                <div class="form__heading font--massive">
                    LOGIN
                </div>
                <input name="username" type="text" placeholder="username"/><br>
                <input name="password" type="password" placeholder="password"/><br>
                <button type="submit">SUBMIT</button>
            </form>
        </div>
        <div class="container__footer font--sub-massive">
            
        </div>
    </div>
</body>
</html>