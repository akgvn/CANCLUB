<?php

session_start();

require_once "dataclasses.php";
require_once "db.php";

if(!isset($_SESSION["user"])) {
    header("Location: login.php");
} else {
    header("Location: stream.php");
}
?>