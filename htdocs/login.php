<?php
	session_start();

	require_once "db.php";
	require_once "User.php";

	if (isset($_SESSION["user"])) {
		header("Location: index.php");
	}

	if (array_key_exists("user", $_POST) && array_key_exists("pass", $_POST)) {
		print_r($_POST); // Print everthing that's posted.
		echo "<br>";

		$user_data = new User;

		$user_data->uname = $_POST["user"];
		$user_data->pass = $_POST["pass"];

		$result = $db->userLogin($user_data);
		

		if ($result) {
			echo "Login successful.";

			header('Location: index.php') ;
		}
		else {
			echo "Password or username mismatch.";
		}
	}
	
?>

<html>

<head>
<link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css" rel="stylesheet">
</head>

	<body>
		<form method = "post">
			<h1>Sign in to Code Arena</h1>
			<label> Username: </label> <input required class="form-control" name = "user"> </input> <br> 	
			<label> Password: </label> <input required class="form-control" name = "pass" type = "password"> </input>
			<br>	
			<input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit" />
			<br>
		<a href="register.php">Register</a>
		</form>
		
	</body>	
</html>

