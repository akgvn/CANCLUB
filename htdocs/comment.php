<?php

// TODO $db->newComment($cmmt)

require_once "header.php";

if(!isset($_REQUEST["aid"])) {
    echo "No id error!";
    exit;
}

$aid = $_REQUEST["aid"];

if (isset($_POST["comment"])) {
    $cmmt = new Comment;
    $user_data = $_SESSION["user"];

    $cmmt->activity_id = $aid;
    $cmmt->comment_date = date("Y-m-d H:i:s");
    $cmmt->commenter_id = $user_data->uid;
    $cmmt->comment_text = $_POST["comment"];

    if ($db->newComment($cmmt)) {
        header("Location: showactivity.php?id=$aid");
    } else {
        // TODO Print not proposed message here!
    }
}

?>

<form method="POST" class="form-group">

    <label> Your Comment:
        <textarea required id="comment" name="comment" class="form-control"></textarea>
    </label><br><br>
        <input type="hidden" name="aid" value='<?php echo $aid ?>'>
        <input type="submit" value="Submit" class="btn btn-primary" />
    </form>
</body>