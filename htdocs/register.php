<?php

session_start();

require_once "db.php";
require_once "User.php";

// If a user is already logged in, redirect to index.php.
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}

// If POST data has been sent, register the user.
if (isset($_POST["user"])) {
    $u_data = new User;

    print_r($_POST);

    $u_data->email = $_POST["mail"];
    $u_data->uname = $_POST["user"];
    $u_data->fname = $_POST["fname"];
    $u_data->lname = $_POST["lname"];
    $u_data->pass = $_POST["pass"];
    $u_data->dept = $_POST["dept"];
    $u_data->birth = $_POST["birth"];

    if($db->registerUser($u_data)) {
        // TODO Print registered message here!
    } else {
        // TODO Print not registered message here!
    }
}

?>

<html>

<body>
    <form action="register.php" method="POST">
        <fieldset>
            <legend>User Details</legend>
            <label> e-Mail: <input required type="text" id="mail" name="mail" size="30" maxlength="100"></label><br><br>
            <label> Username: <input required type="text" id="user" name="user" size="30" maxlength="100"></label><br><br>
            <label> Password: <input required type="password" id="pass" name="pass" size="30" maxlength="100"></label><br>
        </fieldset><br>
        <fieldset>
            <legend>Personal Details</legend>
            <label> First Name <input required type="text" id="fname" name="fname" size="30" maxlength="100"></label><br><br>
            <label> Last Name <input required type="text" id="lname" name="lname" size="30" maxlength="100"></label><br><br>
            <label> Birth Date <input required type="date" id="birth" name="birth"></label><br><br>

            <label> What department are you in?
                <select name="dept">

                    <?php

// List all departments

$depts = $db->getAllDepartments();

foreach ($depts as $d) {
    $depid = $d["dept_id"];
    $depname = $d["dept_name"];
    echo "<option value='$depid'>$depname</option>" . PHP_EOL;
}
?>

                </select>
            </label> <br> <br>
        </fieldset>
        <input type="submit" value="Submit" />
    </form>
</body>