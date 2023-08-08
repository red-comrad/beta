<?php

    require("database.php");

    if(is_conn_alive())
    {
        mysqli_select_db($conn, "world");
        if($_GET["country"] == "")
        {
            $sql = "select Name from country;";
            $ret = mysqli_query($conn, $sql);
            $data = mysqli_fetch_all($ret, MYSQLI_ASSOC);
            $names = [];
            foreach($data as $e)
            {
                array_push($names, $e["Name"]);
            }
            $names = json_encode($names);
            echo $names;
            exit();
        }
        else
        {
            $sql = "select city.Name from city, country where Code = CountryCode and country.Name=\"" . $_GET["country"] . "\";";
            $ret = mysqli_query($conn, $sql);
            $data = mysqli_fetch_all($ret, MYSQLI_ASSOC);
            $names = [];
            $names = [];
            foreach($data as $e)
            {
                array_push($names, $e["Name"]);
            }
            $names = json_encode($names);
            echo $names;
            exit();
        }
    }

?>