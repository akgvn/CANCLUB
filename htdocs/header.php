<?php


require_once "db.php";
require_once "dataclasses.php";

session_start();

// If a user is not already logged in, redirect to login.php.
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
} else {
    $current_user = $_SESSION["user"];
}

?>

<!doctype HTML>

<html>

<head>
<title>CANCLUB by A. Güven</title>
<link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background-color: #f5f5f5;
}

.centered {
  padding-top: 40px;
  padding-bottom: 40px;
  width: 100%;
  max-width: 35%;
  padding: 15px;
  margin: auto;
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
</style>

</head>

<body class="text-center">

<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">CANCLUB</a>
   
    <div class="d-flex justify-content-start" id="navbarNav">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link text-light" href="stream.php">Activities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="stream.php?trending=1">Trend Activities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="proposeactivity.php">Propose Activity</a>
          </li>
          <?php

if($current_user->president) {
    echo "
    <li class=\"nav-item\">
        <a class=\"nav-link text-light\" href=\"listusers.php\">All Users</a>
    </li>
    ";
}

          ?>
        </ul>
    </div>
    <div class="d-flex justify-content-end"> 
        <span class="navbar-text">
        Logged in as: <a href='showuser.php?id=<?php echo $current_user->uid; ?>'><?php echo $current_user->fname . " " . $current_user->lname ?></a>
        <a href="logout.php">(Logout)</a>
        </span>
    </div>
</nav>