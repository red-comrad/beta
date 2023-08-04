<?php
function is_auth()
{
    session_start();
    $ret = isset($_SESSION['username']);
    return $ret;
}

if (!is_auth()) {
    header("location: index.php");
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
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,400;1,100&family=Roboto+Condensed&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="container__header">
            <img src="resource/logo.png" alt=""><span class="font--massive">DEV COMMUNITY</span>
            <span class="link--action">
                <div class="process--circle">

                </div><a href="logout.php">logout</a>
            </span>
        </div>
        <div class="container__body">
            <div class="container__body__content">
                MAKE PROFILE SECTION
            </div>
        </div>
        <div class="container__footer font--sub-massive">
            SUBCRIBE TO OUR NEWSLETTER
            <br>
            <form action="index.php" method="POST">
                <input class="font--lighter" type="text" name="name" placeholder="YOUR NAME" />
                <input class="font--lighter" type="text" name="email" placeholder="YOUR EMAIL" />
                <button type="submit">SUBMIT</button>
            </form>
        </div>
    </div>
</body>

</html>