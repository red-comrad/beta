<?php

    session_start();
    $_SESSION["init"] = "true";
    $_SESSION["lon"] = $_GET["lon"];
    $_SESSION["lat"] = $_GET["lat"];
    $url = "https://api.open-meteo.com/v1/forecast?latitude=" . $_SESSION["lat"] . "&longitude=" . $_SESSION["lon"] . "&current_weather=true";

    $file = fopen($url, "rb");
    $data = "";
    if($file)
    {
        while(!feof($file))
        {
            $data .= fread($file, 1024);
        }
    }

    $data = json_decode($data, true);
    
    $_SESSION["tem"] = $data["current_weather"]["temperature"];

    echo "done";
?>