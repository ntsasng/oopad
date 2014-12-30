<?php
session_start();
require "class.php";
require "user.php";
$err = "";
if ($_SESSION['se_level'] != 1) {
	header('location: login.php');
	exit();
}
if (isset($_POST['ok'])) {
	$u = $p = "";
	if ($_POST['username'] == NULL) {
		$err[] = "Plz input your username";
	} else {
		$u = $_POST['username'];
	}
	if ($_POST['password'] == NULL) {
		$err[] = "Plz input your password";
	} else {
		if ($_POST['password'] != $_POST['repassword']) {
			$err[] = "Password not match";
		} else {
			$p = $_POST['password'];
		}
	}
	$l = $_POST['level'];
	if ($u & $p & $l) {
		$muser = new User;
		$muser->setUsername($u);
		$muser->setPassword($p);
		$muser->setLevel($l);
		if ( $muser->checkUser() == false ) {
			$err[] = "Username already, try another username";
		} else {
			$muser->insertUser();
			header('location: index.php');
			exit();
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Form</title>
</head>
<body>
	<?php
		if ($err != "") {
			echo "<ul>";
			foreach ($err as $e) {
				echo "<li>$e</li>";
			}
		echo "</ul>";
		}
	?>
	<form action="add_user.php" method="post">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" /><br />
		Re-Password: <input type="password" name="repassword" /><br />
		Level: <select name="level" id="">
			<option value="1">Admin</option>
			<option value="2">Member</option>
		</select><br />
		<input type="submit" name="ok" value="Submit">
	</form>
</body>
</html>