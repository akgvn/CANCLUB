<?php

require_once "header.php";

if(!isset($_GET["id"])) {
    echo "<h3>No activity id given!</h3>";
    exit;
}

$act = $db->getActivityByID($_GET["id"]);
$act = arrToAct($act);
$proposer = $db->getUserData($act->proposed_by);
$type = $act->activity_type;
$type = $db->getActType($type);

echo "
<div class='card text-center'>
  <div class='card-header'>
    Activity Proposal by: <a href='showuser.php?id=$proposer->uid'>$proposer->fname $proposer->lname</a>
  </div>
  <div class='card-body'>
    <h5 class='card-title'>$act->activity_title</h5>
    <p class='card-text'>$act->activity_info</p>
    
  </div>
  <ul class='list-group list-group-flush'>
  <li class='list-group-item'>
";

// FIXME IF NOT VOTED
echo "<a href='#' class='btn btn-primary'>Approve</a>
    <a href='#' class='btn btn-primary'>Disapprove</a> ";

// FIXME IF VOTED

echo "You've voted this proposal. Votes: $act->vote_count";

echo "
  </li>
  <li class='list-group-item'>
  Activity Type: $type
  </li>
  </ul>
  <div class='card-footer text-muted'>
    Proposed $act->proposal_time
  </div>
</div>
";

// TODO ADD COMMENTS!

?>