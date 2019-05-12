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
}

function arrToUser($userArray)
{
    $user = new User;

    $user->uid = $userArray["id"];
    $user->email = $userArray["email"];
    $user->uname = $userArray["username"];
    $user->fname = $userArray["fname"];
    $user->lname = $userArray["lname"];
    $user->pass = $userArray["password"];
    $user->dept = $userArray["dept_id"];
    $user->birth = $userArray["birthdate"];
    $user->president = $userArray["has_president_rights"];

    return $user;
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
    public $proposal_time;
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

class Comment
{
    public $comment_id;
    public $commenter_id;
    public $activity_id;
    public $comment_text;
    public $comment_date;
}
