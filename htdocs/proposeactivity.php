<?php

require_once "header.php";

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


<form method="POST" class="form-group">

    <label> Activity Title:
        <input required type="text" id="title" name="title" size="30" maxlength="63" class="form-control">
    </label><br><br>
    <label> Your Proposal:
        <textarea required id="info" name="info" class="form-control"></textarea>
    </label><br><br>
    <label> What type of Activity is your proposal?
        <select name="type" class="form-control">
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
        <input type="submit" value="Submit" class="btn btn-primary" />
    </form>
</body>