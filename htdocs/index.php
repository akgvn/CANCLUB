<?php

session_start();

require_once "User.php";
require_once "db.php";

print_r($_SESSION["user"]);

echo "<h1> HELLO WORLD! </h1>";
?>