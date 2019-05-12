<?php

// TODO post for change data

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

    // print_r($_POST);

    $u_data->email = $_POST["mail"];
    $u_data->uname = $_POST["user"];
    $u_data->fname = $_POST["fname"];
    $u_data->lname = $_POST["lname"];
    $u_data->pass = $_POST["pass"];
    $u_data->dept = $_POST["dept"];
    $u_data->birth = $_POST["birth"];

    if ($db->registerUser($u_data)) {
        header("Location: index.php");
        // TODO Print registered message here!
    } else {
        // TODO Print not registered message here!
    }

}

// Image upload
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = explode('.', $_FILES['image']['name']);
    $file_ext = strtolower(end($file_ext));

    if ($file_ext !== "jpeg") {
        $errors[] = "extension not allowed, please choose a JPEG file.";
    }

    if ($file_size > 2100000) {
        $errors[] = 'File size must not exceed 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $_POST["user"] . ".jpeg");
    } else {
        print_r($errors);
    }
}

?>
<html>

<head>
<link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css" rel="stylesheet">
<title>CANCLUB Registration</title>
</head>

<body style="padding-top: 40px;padding-bottom: 40px;width: 100%;max-width: 35%;padding: 15px;margin: auto;position: relative;box-sizing: border-box;height: auto;padding: 10px;font-size: 16px;">
    <form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <fieldset>
            <legend>User Details</legend>
            <label> e-Mail: <input required type="text" id="mail" name="mail" size="30" maxlength="100" class="form-control"></label><br><br>
            <label> Username: <input required type="text" id="user" name="user" size="30" maxlength="100" class="form-control"></label><br><br>
            <label> Password: <input required type="password" id="pass" name="pass" size="30" maxlength="100" class="form-control"></label><br>
        </fieldset><br>
        <fieldset>
            <legend>Personal Details</legend>
            <label> Upload Picture<input type="file" name="image" class="form-control-file"/> </label>
            <label> First Name <input required type="text" id="fname" name="fname" size="30" maxlength="100" class="form-control"></label><br><br>
            <label> Last Name <input required type="text" id="lname" name="lname" size="30" maxlength="100" class="form-control"></label><br><br>
            <label> Birth Date <input required type="date" id="birth" name="birth" class="form-control"></label><br><br>

            <label> What department are you in?
                <select name="dept" class="form-control"  >

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
    </div>
    </form>
</body>