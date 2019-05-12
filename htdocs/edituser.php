<?php

session_start();

require_once "db.php";
require_once "dataclasses.php";

if(!isset($_POST["uid"])) {
    header("Location: index.php");
}

$us = $db->getUserData($_POST["uid"]);

if (isset($_POST["mail"])) {
    $u_data = new User;

    // print_r($_POST);

    $u_data->email = $_POST["mail"];
    $u_data->uname = $us->uname;
    $u_data->fname = $_POST["fname"];
    $u_data->lname = $_POST["lname"];
    $u_data->pass = $_POST["pass"];
    $u_data->dept = $_POST["dept"];
    $u_data->birth = $_POST["birth"];

    $u_data->uid = $us->uid;
    if ($db->updateUser($u_data)) {
        $_SESSION["user"] = $u_data;
        header("Location: index.php");
    } else {
        // TODO Print not changed message here!
    }

}

?>
<html>

<head>
<link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css" rel="stylesheet">
<title>CANCLUB Edit User</title>
</head>

<body style="padding-top: 40px;padding-bottom: 40px;width: 100%;max-width: 35%;padding: 15px;margin: auto;position: relative;box-sizing: border-box;height: auto;padding: 10px;font-size: 16px;">
    <form method="POST">
    <div class="form-group">
        <fieldset>
            <legend>User Details</legend>
            <label> e-Mail: <input required type="text" id="mail" name="mail" size="30" maxlength="100" class="form-control" value='<?php echo $us->email ?>'></label><br><br>
            <label> Username: <input disabled required type="text" id="user" name="user" size="30" maxlength="100" class="form-control" value='<?php echo $us->uname ?>'></label><br><br>
            <label> Password: <input required type="password" id="pass" name="pass" size="30" maxlength="100" class="form-control"></label><br>
        </fieldset><br>
        <fieldset>
            <legend>Personal Details</legend>
            <label> First Name <input required type="text" id="fname" name="fname" size="30" maxlength="100" class="form-control" value='<?php echo $us->fname ?>'></label><br><br>
            <label> Last Name <input required type="text" id="lname" name="lname" size="30" maxlength="100" class="form-control" value='<?php echo $us->lname ?>'></label><br><br>
            <label> Birth Date <input required type="date" id="birth" name="birth" class="form-control" value='<?php echo $us->birth ?>'></label><br><br>

            <label> What department are you in?
                <select name="dept" class="form-control"  >

                    <?php

// List all departments

$depts = $db->getAllDepartments();

foreach ($depts as $d) {
    $depid = $d["dept_id"];
    $depname = $d["dept_name"];

    if ($us->dept == $depid) {
        echo "<option selected value='$depid'>$depname</option>" . PHP_EOL;
    } else {
        echo "<option value='$depid'>$depname</option>" . PHP_EOL;
    }
}
?>

                </select>
            </label> <br> <br>
        </fieldset>
        <input type="hidden" name="uid" value=<?php echo $us->uid ?> />
        <input type="submit" value="Submit" />
    </div>
    </form>
</body>