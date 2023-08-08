<?php
    require("database.php");
    function is_auth()
    {
        session_start();
        $ret = isset($_SESSION['username']);
        return $ret;
    }

    if (!is_auth()) {
        header("location: index.php");
    }
    $fields = ["country", "city"];
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(!isset($_SESSION["profile"]))
        {
            $_SESSION["profile_percent"] = 0.0;
            $_SESSION["profile"] = [];
        }
        
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

        if(is_conn_alive())
        {
            $address = $_POST["country"] . "&" . $_POST["city"];
            mysqli_select_db($conn, "php_assignment");
            $sql = "update users set address=\"" .$address. "\" where username=\"".$_SESSION["email"] . "\";";
            $ret = mysqli_query($conn, $sql);
        }
    }
    else
    {
        mysqli_select_db($conn, "php_assignment");
        $ret = mysqli_query($conn, "select address from users where username=\"" . $_SESSION["email"] . "\";");
        if($ret)
        {
            $row = mysqli_fetch_assoc($ret);
            $data = explode("&", $row["address"]);
            $_SESSION["profile"]["country"] = $data[0];
            $_SESSION["profile"]["city"] = $data[1];

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
                    <select name="country" id="country">
                        <option value="">SELECT COUNTRY</option>
                    </select><br>
                    <select name="city" id="city">
                        <option value="">SELECT CITY</option>
                    </select><br>
                    <button type="submit">SUBMIT</button>
                </form>
            </div>
            <div id="output">

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
    <script>
        let country = document.getElementById("country");
        let city = document.getElementById("city");
        let info = [<?php echo "\"" . $_SESSION["profile"]["country"] . "\""; ?>, <?php echo "\"" . $_SESSION["profile"]["city"] . "\""; ?>];
        
        async function update()
        {
            city.innerHTML = "<option value=\"\">SELECT CITY</option>";
            info[0] = country.value;
            info[1] = city.value;
            if(info[0] == "")
            {
                let data = await fetch("info.php");
                data = await data.json();
                for(var i=0; i<data.length; i++)
                {
                    let node = document.createElement("option");
                    node.innerHTML = data[i];
                    node.setAttribute("value", data[i]);
                    country.appendChild(node);
                }
            }
            if(info[0] != "")
            {
                let data = await fetch("info.php?country=" + info[0]);
                data = await data.json();
                for(var i=0; i < data.length; i++)
                {
                    let node = document.createElement("option");
                    node.innerHTML = data[i];
                    node.setAttribute("value", data[i]);
                    city.appendChild(node);
                }
            }
        }
        country.addEventListener("change", update);

        async function profile_init()
        {
            city.innerHTML = "<option value=\"\">SELECT CITY</option>";
            let data = await fetch("info.php");
            data = await data.json();
            for(var i=0; i<data.length; i++)
            {
                let node = document.createElement("option");
                node.innerHTML = data[i];
                node.setAttribute("value", data[i]);
                country.appendChild(node);
            }
            if(info[0] != "")
            {
                let data = await fetch("info.php?country=" + info[0]);
                data = await data.json();
                for(var i=0; i < data.length; i++)
                {
                    let node = document.createElement("option");
                    node.innerHTML = data[i];
                    node.setAttribute("value", data[i]);
                    city.appendChild(node);
                }
            }
            console.log(info);
            let options = country.getElementsByTagName('option');
            for(var i=0; i < options.length; i++)
            {
                if(options[i].value == info[0])
                {
                    options[i].selected = true;
                    country.value = info[0];
                }
            }
            options = city.getElementsByTagName('option');
            for(var i=0; i < options.length; i++)
            {
                if(options[i].value == info[1])
                {
                    options[i].selected = true;
                    city.value = info[1];
                }
            }
        }
        profile_init();
    </script>
    <?php  echo var_dump($_SESSION); ?>
</body>

</html>