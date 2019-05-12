<?php

require_once "header.php";

if (!isset($_GET["id"])) {
    echo "<h3>No activity id given!</h3>";
    exit;
}



$act = $db->getActivityByID($_GET["id"]);
$act = arrToAct($act);
$proposer = $db->getUserData($act->proposed_by);
$type = $act->activity_type;
$type = $db->getActType($type);

$vote = new Vote;
$vote->activity_id = $_GET["id"];
$vote->voter_id = $current_user->uid;

$voted = $db->isVoted($vote);

if (isset($_GET["value"]) && !$voted) {
  $vote->value = $_GET["value"];
  if($db->voteActivity($vote)) {
    header("Refresh:0");
  }
}

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

if (!$voted) {
    echo "<a href='showactivity.php?id=$act->activity_id&value=1' class='btn btn-primary'>Approve</a>
<a href='showactivity.php?id=$act->activity_id&value=-1' class='btn btn-primary'>Disapprove</a> ";
} else {
    echo "You've voted this proposal. Votes: $act->vote_count";
}
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
