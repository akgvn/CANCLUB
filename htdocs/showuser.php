<?php

require_once "header.php";

if (!isset($_GET["id"])) {
    echo "<h3>No user id given!</h3>";
    exit;
}

$canEdit = 0;

if ($current_user->uid == $_GET["id"]) {
    $canEdit = 1;
}

if (!(($current_user->president) || ($canEdit))) {
    echo "<h3>You can't access this page</h3>";
    exit;
}

$user = $db->getUserData($_GET["id"]);
$deptn = $db->getDeptName($user->dept);

// print_r($user);

echo "
<div class='card'>
  <img class='card-img-top' src='images/$user->uname.jpeg' alt='User picture is not found.' style='max-width: 15%;margin: auto;position: relative;'>
  <div class='card-body'>
    <h5 class='card-title'>$user->fname $user->lname's Data</h5>
    <p class='card-text'><strong>Username:</strong> $user->uname</p>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'><strong>Birth Date:</strong> $user->birth</li>
    <li class='list-group-item'><strong>eMail:</strong> $user->email</li>
    <li class='list-group-item'><strong>Department:</strong> $deptn </li>
  </ul>
";

if ($canEdit) {
    echo "
  <div class='card-body'>
    <form method='POST' action='edituser.php'>
      <input hidden id='uid' name='uid' value='$user->uid'/>
      <input hidden id='change' value=1 />
      <button type='submit' class='btn btn-outline-danger'>Edit Info</button>
    </form>
  </div>
";
}

echo "
</div>
";
