<?php

require_once "header.php";

if (!isset($_GET["id"])) {
    echo "<h3>No activity id given!</h3>";
    exit;
}

$act = $db->getActivityByID($_GET["id"]);
$act = arrToAct($act);

// NOTE 15 days = 15 * 24 * 60 * 60 seconds

$expired = strtotime($act->proposal_time) + 15 * 24 * 60 * 60;

if (time() > $expired) {
    $expired = true;
} else {
    $expired = false;
}

$proposer = $db->getUserData($act->proposed_by);
$type = $act->activity_type;
$type = $db->getActType($type);

$vote = new Vote;
$vote->activity_id = $_GET["id"];
$vote->voter_id = $current_user->uid;

$voted = $db->isVoted($vote);

if (isset($_GET["value"]) && !$voted) {
    $vote->value = $_GET["value"];
    if ($db->voteActivity($vote)) {
        header("Refresh:0");
    }
}

echo "
<div class='card text-center'>
  <div class='card-header'>
    Activity Proposal by: <a href='showuser.php?id=$proposer->uid'>$proposer->fname $proposer->lname</a>
  </div>
  <div class='card-body'>
    <h4 class='card-title'>$act->activity_title</h4>
    <p class='card-text'>$act->activity_info</p>

  </div>
  <ul class='list-group list-group-flush'>
  <li class='list-group-item'>
";

if ($expired) {
    echo "15 days passed since this proposal. Votes: $act->vote_count";
} else if (!$voted) {
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

$cmmts = $db->getComments($act->activity_id); // comment_text, commenter_id

if (count($cmmts) > 0) {

    echo "
<div class='card'>
  <div class='card-header'>
    <h5>Comments</h5>
  </div>
  <div class='card-body'>
  <ul class='list-group list-group-flush'>
";

    foreach ($cmmts as $c) {
      $txt = $c["comment_text"];
      $usr = $c["commenter_id"];
      $usr = $db->getUserData($usr);
      $usr = $usr->fname;
      $dt = $c["comment_date"];


        echo "
    <li class='list-group-item'>
    <div class='text-left'>$usr commented: '$txt'</div>
    <div class='text-right'>$dt</div>
    </li>
";
    }

    echo "
  </ul>
  </div>
</div>
";

}

echo "<a href='comment.php?aid=$act->activity_id' class='btn btn-primary'>Comment</a>";
