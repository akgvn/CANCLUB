<?php

require_once "header.php";

?>

<div class='centered'>

<?php

$allProposals = $db->getActivitiesInOrder(); // TODO use this to list all proposals.

// print_r($allProposals);

foreach ($allProposals as $p) {
    $act = arrToAct($p);
    $link = "<a href='showactivity.php?id=$act->activity_id'>$act->activity_title</a>";

    echo "
<div class=\"card\" style=\"width: 25rem;\">
  <div class=\"card-body\">
  <h5 class=\"card-title\">$link</h5>
    $act->activity_info <br>
  </div>
</div>
<br>
";
}

?>

</div>