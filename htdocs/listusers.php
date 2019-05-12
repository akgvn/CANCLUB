<?php

require_once "header.php";

if (!$current_user->president) {
    echo "Restricted access!";
    exit;
}

if (isset($_GET["delete"])) {
    if ($db->deleteUser($_GET["delete"])) {
        header("Location: listusers.php");
    } else {
        echo "<br>Couldn't delete user.";
    }
}

echo "
<div class='card'>
  <div class='card-header'>
    List of Users
  </div>
  <ul class='list-group list-group-flush'>
";

$users = $db->getUserList();

foreach ($users as $u) {
    $u = arrToUser($u);
    echo "
    <li class='list-group-item'>
    $u->uname: <a href='showuser.php?id=$u->uid'>$u->fname $u->lname</a>
    <a href='listusers.php?delete=$u->uid'>(Delete)</a>
    </li>
    ";
}

echo "
</ul>
</div>
";
