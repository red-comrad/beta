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

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(!isset($_SESSION["profile"]))
        {
            $_SESSION["profile_percent"] = 0.0;
            $_SESSION["profile"] = [];
        }
        $fields = ["topic", "education", "profession", "hobbies"];
        foreach($fields as $field)
        {
            if(isset($_POST[$field]))
            {
                $_SESSION["profile"][$field] = $_POST[$field];
            }
        }
        $cnt=0.0;
        foreach($fields as $field)
        {
            if(isset($_SESSION["profile"][$field]) and !empty($_SESSION["profile"][$field]))
            {
                $cnt = $cnt + 1.0;
            }
        }
        $_SESSION["profile_percent"] = $cnt / count($fields);
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
            <img src="resource/logo.png" alt=""><span class="font--massive"><a href="index.php">DEV COMMUNITY</a></span>
            <span class="link--action">
                <div class="process--circle" style="<?php
                                                        $val = $_SESSION["profile_percent"] * 90 + 10;
                                                        echo "background: conic-gradient(rgb(29, 227, 234) 0.00% $val%, rgb(63, 63, 63) $val%);"
                                                    ?>">

                </div><a href="logout.php">logout</a>
            </span>
        </div>
        <div class="container__body">
            <div class="container__body__content">
                <form action="profile.php" method="POST">
                    <div class="form__heading font--massive">
                        YOUR PROFILE DETAILS
                    </div>
                    <input name="topic" type="text" placeholder="topic" value="<?php echo $_SESSION["profile"]["topic"] ?>"/><br>
                    <input name="education" type="text" placeholder="education" value="<?php echo $_SESSION["profile"]["education"] ?>"/><br>
                    <input name="profession" type="text" placeholder="profession" value="<?php echo $_SESSION["profile"]["profession"] ?>"/><br>
                    <input name="hobbies" type="text" placeholder="hobbies" value="<?php echo $_SESSION["profile"]["hobbies"] ?>"/><br>
                    <button type="submit">SUBMIT</button>
                </form>
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