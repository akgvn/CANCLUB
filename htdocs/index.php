<?php

session_start();

require_once "User.php";
require_once "db.php";

if(!isset($_SESSION["user"])) {
    header("Location: login.php");
} else {
    header("Location: stream.php");
}

echo "<h1> HELLO WORLD! </h1>";
?>