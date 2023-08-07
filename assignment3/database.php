<?php

    $filename = __DIR__ . $_SERVER['PHP_SELF'];
    if ($filename == __FILE__) {
        header("HTTP/1.1 401 Unauthorized");
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "mysql";

    $conn = new mysqli($servername, $username, $password);

    function is_conn_alive() {
        return mysqli_connect_errno() == 0;
    }

?>