<?php

require_once "db.php";
require_once "User.php";
require_once "Activity.php";

session_start();

// If a user is not already logged in, redirect to login.php.
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

if (isset($_POST["title"])) {
    $a_data = new Activity;
    $user_data = $_SESSION["user"];

    print_r($_POST); // FIXME delete this line later

    $a_data->activity_title = $_POST["title"];
    $a_data->activity_info = $_POST["info"];
    $a_data->activity_type = $_POST["type"];

    $a_data->activity_id = ""; // FIXME is not needed?
    $a_data->proposal_time = date("Y-m-d H:i:s");
    $a_data->proposed_by = $user_data->uid;

    if ($db->proposeActivity($a_data)) {
        // TODO Print proposed message here!
    } else {
        // TODO Print not proposed message here!
    }
}

?>

<html>

<body>
    <form method="POST">

            <label> Activity Title:
                <input required type="text" id="title" name="title" size="30" maxlength="63">
            </label><br><br>
            <label> Your Proposal:
                <textarea required id="info" name="info"></textarea>
            </label><br><br>
            <label> What type of Activity is your proposal?
                <select name="type">

<?php

// List all Activity types

$types = $db->getActivityTypes();

foreach ($types as $t) {
    $typid = $t["type_id"];
    $typname = $t["type_name"];
    echo "<option value='$typid'>$typname</option>" . PHP_EOL;
}
?>

                </select>
            </label> <br> <br>
        </fieldset>
        <input type="submit" value="Submit" />
    </form>
</body>