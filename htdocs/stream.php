<?php

// TODO:
// - Get all activities in new->old order and list them.

session_start();

require_once "db.php";

$allProposals = $db->getActivitiesInOrder();

print_r($allProposals);

?>

<a href="proposeactivity.php">Propose Act</a>