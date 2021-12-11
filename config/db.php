<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "blog";

date_default_timezone_set('US/Pacific');

$db_connect = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$db_connect) {
    die("Database Connection Failed");
}
