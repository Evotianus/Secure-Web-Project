<?php
function openConnection()
{
    $mysqli = mysqli_connect("localhost", "user", "helloworld12345", "secure_web_database");

    if (!$mysqli) {
        die("Connection Failed!" . mysqli_connect_error());
    }

    return $mysqli;
}
