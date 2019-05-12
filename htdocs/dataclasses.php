<?php

class User
{
    public $uid;
    public $email;
    public $uname;
    public $fname;
    public $lname;
    public $pass;
    public $dept;
    public $birth;
    public $president = 0;

    public function update()
    {
        // TODO If this user is in the db, updates data in db. Otherwise inserts new data to db.
    }

}

class Vote
{
    public $vote_id;
    public $value;
    public $activity_id;
    public $voter_id;
}

class Activity
{
    public $activity_id;
    public $activity_title;
    public $activity_info;
    public $activity_type;
    public $proposal_time; // NOTE 15 days = 15 * 24 * 60 * 60 seconds
    public $proposed_by;
    public $vote_count;
}

function arrToAct($actArray)
{
    $act = new Activity;

    $act->activity_id = $actArray["activity_id"];
    $act->activity_title = $actArray["activity_title"];
    $act->activity_info = $actArray["activity_info"];
    $act->activity_type = $actArray["activity_type"];
    $act->proposal_time = $actArray["proposal_time"];
    $act->proposed_by = $actArray["proposed_by"];
    $act->vote_count = $actArray["vote_count"];

    return $act;
}

?>