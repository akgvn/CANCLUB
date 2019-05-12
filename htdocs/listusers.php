<?php

require_once "header.php";

if(!$current_user->president) {
    echo "Restricted access!";
    exit;
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
    </li>
    ";
}

echo "
</ul>
</div>
";
?>