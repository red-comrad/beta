<?php

    session_start();

    if(!isset($_SESSION["init"]))
    {
        ?>
        <html>
            <body>
            <h1>PLEASE WAIT <span id="loading"></span></h1>
                <script>
                    if ("geolocation" in navigator) {
                        navigator.geolocation.getCurrentPosition(async (position, error)=>{
                            fetch("locateme.php?lat=" + await position.coords.latitude + "&lon=" + await position.coords.longitude).then(()=>{
                                window.location.replace("index.php");
                            });
                        });
                    }
                    let loading = document.getElementById("loading");
                    let counter = 0;
                    function update()
                    {
                        let content = "";
                        for(var i=0; i < counter%5; i++)
                        {
                            content += ".";
                        }
                        loading.innerText =content;
                        counter++;
                    }
                    setInterval(update, 200);
                </script>
            </body>
        </html>
        <?php
        exit();
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
            <span class="link--action"><a href="logout.php">reset</a></span>
        </div>
        <div class="container__body">
            <div class="container__body__content">
                TEMPERATURE OF YOUR LOCATION
                <br>
                <?php
                    echo $_SESSION["tem"] . "&deg C";
                ?>
            </div>
        </div>
        <div class="container__footer font--sub-massive">
        </div>
    </div>
</body>
</html>